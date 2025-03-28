<?php

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Arret.php';
require_once RACINE . '/classes/LigneBus.php';

class ArretService {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($o) {
        try {
            $query = "INSERT INTO arret (`coordonnees`, `longitude`, `latitude`, `ligne_id`) 
                  VALUES (:coordonnees, :longitude, :latitude, :ligne_id)";
            $stmt = $this->connexion->getConnexion()->prepare($query);

            // Lier les valeurs de l'objet
            $stmt->bindParam(':coordonnees', $o->getCoordonnees(), PDO::PARAM_STR);
            $stmt->bindParam(':longitude', $o->getLongitude(), PDO::PARAM_STR);
            $stmt->bindParam(':latitude', $o->getLatitude(), PDO::PARAM_STR);
            $stmt->bindParam(':ligne_id', $o->getLigneBus()->getId(), PDO::PARAM_INT);

            $stmt->execute();
        } catch (PDOException $e) {
            die("Erreur SQL : " . $e->getMessage());
        }
    }

    public function deleteArret($id) {
        if (!$this->findById($id)) {
            die("⚠️ Erreur : L'arrêt n'existe pas.");
        }

        $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM arret WHERE id = ?");
        $stmt->execute([$id]);

        // Recharger la page après suppression
        header("Location: " . $_SERVER['HTTP_REFERER']);
        exit();
    }

    public function findAll() {
        $arrets = array();
        $query = "SELECT arret.*, lignebus.code AS ligne_code 
              FROM arret 
              INNER JOIN lignebus ON arret.ligne_id = lignebus.id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();

        while ($a = $req->fetch(PDO::FETCH_OBJ)) {
            $ligneBus = new LigneBus($a->ligne_id, $a->ligne_code);
            $arrets[] = new Arret($a->id, $a->coordonnees, $a->longitude, $a->latitude, $ligneBus);
        }

        return $arrets;
    }

    public function findById($id) {
        $query = "SELECT * FROM arret WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();

        if ($a = $req->fetch(PDO::FETCH_OBJ)) {
            $ligneBus = new LigneBus($a->ligne_id, "Code inconnu");
            return new Arret($a->id, $a->coordonnees, $a->longitude, $a->latitude, $ligneBus);
        }
        return null;
    }

    public function findAllApi() {
        $query = "select * from arret";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
