<?php

// ✅ Définition de la constante RACINE si elle n'est pas encore définie
if (!defined('RACINE')) {
    define('RACINE', dirname(__DIR__));
}

require_once RACINE . '/dao/IDao.php';
require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Bus.php';

class BusService implements IDao {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function create($bus) {
        $sql = "INSERT INTO bus (matricule, etat, ligne_id) VALUES (:matricule, :etat, :ligne_id)";
        $stmt = $this->connexion->getConnexion()->prepare($sql);
        $stmt->execute([
            ':matricule' => $bus->getMatricule(),
            ':etat' => $bus->getEtat(),
            ':ligne_id' => $bus->getLigneId()
        ]);
    }

    public function findAll() {
        $buses = array();
        $query = "SELECT * FROM bus";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();

        while ($b = $req->fetch(PDO::FETCH_OBJ)) {
            $buses[] = new Bus($b->id, $b->matricule, $b->etat, $b->ligne_id);
        }

        return $buses;
    }

    public function findById($id) {
        $query = "SELECT * FROM bus WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->bindParam(':id', $id, PDO::PARAM_INT);
        $req->execute();
        if ($b = $req->fetch(PDO::FETCH_OBJ)) {
            return new Bus($b->id, $b->matricule, $b->etat, $b->ligne_id);
        }
        return null;
    }

    public function update($bus) {
        $query = "UPDATE bus SET matricule = :matricule, etat = :etat, ligne_id = :ligne_id WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([
            ":id" => $bus->getId(),
            ":matricule" => $bus->getMatricule(),
            ":etat" => $bus->getEtat(),
            ":ligne_id" => $bus->getLigneId()
        ]);
    }

    public function delete($id) {
        $query = "DELETE FROM bus WHERE id = :id";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute([":id" => $id]);
    }

    // ✅ API: retourne un tableau associatif pour l’API REST
    public function findAllApi() {
        $query = "SELECT * FROM bus";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>
