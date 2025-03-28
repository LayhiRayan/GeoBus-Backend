<?php

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Administrateur.php';

class AdministrateurService {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        try {
            // Insert into utilisateur table
            $query1 = "INSERT INTO utilisateur (`nom`, `prenom`, `email`, `motDePasse`) VALUES (:nom, :prenom, :email, :motDePasse)";
            $stmt1 = $this->connexion->getConnexion()->prepare($query1);

            // Utiliser des variables intermédiaires
            $nom = $o->getNom();
            $prenom = $o->getPrenom();
            $email = $o->getEmail();
            $motDePasse = $o->getMotDePasse();

            $stmt1->bindParam(':nom', $nom, PDO::PARAM_STR);
            $stmt1->bindParam(':prenom', $prenom, PDO::PARAM_STR);
            $stmt1->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt1->bindParam(':motDePasse', $motDePasse, PDO::PARAM_STR);

            $stmt1->execute();

            // Get the last inserted ID
            $lastId = $this->connexion->getConnexion()->lastInsertId();

            // Insert into administrateur table
            $query2 = "INSERT INTO administrateur (`id`) VALUES (:id)";
            $stmt2 = $this->connexion->getConnexion()->prepare($query2);
            $stmt2->bindParam(':id', $lastId, PDO::PARAM_INT);
            $stmt2->execute();
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function deleteAdministrateur($id) {
        $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM administrateur WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAllAdministrateurs() {
        $stmt = $this->connexion->getConnexion()->query("
        SELECT utilisateur.id, utilisateur.nom, utilisateur.prenom, utilisateur.email, utilisateur.motDePasse
        FROM utilisateur 
        INNER JOIN administrateur ON utilisateur.id = administrateur.id
    ");
        $stmt->execute();

        // ✅ Fetch all rows as an associative array (avoiding object conversion issues)
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getAdministrateurById($id) {
        $stmt = $this->connexion->getConnexion()->prepare("SELECT * FROM administrateur WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAllApi() {
        $query = "select * from administrateur";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}
