<?php

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Usager.php';

class UsagerService {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function createUsager(Usager $usager) {
        if (!$this->connexion) {
            throw new Exception("Database connection is not initialized.");
        }

        try {
            // Start a transaction
            $this->connexion->getConnexion()->beginTransaction();

            // Insert into `utilisateur`
            $stmt = $this->connexion->getConnexion()->prepare("INSERT INTO utilisateur (nom, prenom, email, motDePasse) VALUES (?, ?, ?, ?)");
            $stmt->execute([
                $usager->getNom(),
                $usager->getPrenom(),
                $usager->getEmail(),
                $usager->getMotDePasse()
            ]);

            // Get the last inserted ID
            $userId = $this->connexion->getConnexion()->lastInsertId();

            // Insert into `usager` table
            $stmt = $this->connexion->getConnexion()->prepare("INSERT INTO usager (id) VALUES (?)");
            $stmt->execute([$userId]);

            // Commit the transaction
            $this->connexion->getConnexion()->commit();
        } catch (Exception $e) {
            // Rollback if there is an error
            $this->connexion->getConnexion()->rollBack();
            throw new Exception("Erreur lors de l'insertion de l'usager : " . $e->getMessage());
        }
    }

    public function deleteUsager($id) {
        try {
            $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM usager WHERE id = ?");
            $stmt->execute([$id]);

            // Also delete from `utilisateur` table if needed
            $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM utilisateur WHERE id = ?");
            $stmt->execute([$id]);
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la suppression de l'usager : " . $e->getMessage());
        }
    }

    public function getAllUsagers() {
    $stmt = $this->connexion->getConnexion()->query("
        SELECT utilisateur.id, utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.motDePasse
        FROM utilisateur 
        INNER JOIN usager ON utilisateur.id = usager.id
    ");
    
    $usagers = [];
    while ($u = $stmt->fetch(PDO::FETCH_OBJ)) {
        $usagers[] = new Usager($u->id, $u->nom, $u->prenom, $u->email, $u->motDePasse);
    }

    return $usagers;
}


    public function getUsagerById($id) {
        try {
            $stmt = $this->connexion->getConnexion()->prepare("SELECT u.id, u.nom, u.prenom, u.email, u.motDePasse 
                                                           FROM utilisateur u 
                                                           JOIN usager us ON u.id = us.id 
                                                           WHERE us.id = ?");
            $stmt->execute([$id]);

            $u = $stmt->fetch(PDO::FETCH_OBJ);

            if ($u) {
                return new Usager($u->id, $u->nom, $u->prenom, $u->email, $u->motDePasse);
            } else {
                return null; // No user found
            }
        } catch (Exception $e) {
            throw new Exception("Erreur lors de la récupération de l'usager : " . $e->getMessage());
        }
    }

    public function findAllApi() {
        $query = "select * from usager";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
