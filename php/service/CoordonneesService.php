<?php

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Coordonnees.php';

class CoordonneesService {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function createCoordonnees(Coordonnees $coordonnees) {
        

        $stmt = $this->connexion->getConnexion()->prepare("INSERT INTO coordonnees (date) VALUES (?)");
        $stmt->execute([$coordonnees->getDate()]);
    }

    public function deleteCoordonnees($id) {
        $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM coordonnees WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAllCoordonnees() {
        $coordonneesList = array();
        $query = "SELECT * FROM coordonnees";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();

        while ($c = $req->fetch(PDO::FETCH_OBJ)) {
            $coordonneesList[] = [
                "id" => $c->id,
                "date" => $c->date
            ];
        }

        return $coordonneesList;
    }

    public function getCoordonneesById($id) {
        $stmt = $this->connexion->getConnexion()->prepare("SELECT * FROM coordonnees WHERE id = ?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findAllApi() {
        $query = "select * from coordonnees";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }

}

?>
