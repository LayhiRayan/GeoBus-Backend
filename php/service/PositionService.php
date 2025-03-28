<?php

include_once 'dao/IDao.php';
include_once 'classe/Position.php';
include_once 'connexion/Connexion.php';

 class PositionService implements IDao {

    private $listPosition = array();
    private $connexion;
    private $position;

    public function __construct() {
        $this->connexion = new Connexion();
        $this->position = new Position("", "", "", "", "");
    }

    public function create($position) {
        $query = "INSERT INTO position (latitude, longitude, date, imei) VALUES ("
                . $position->getLatitude() . "," . $position->getLongitude() . ",'" . $position > getDate() . "','" . $position->getImei() . "')";
        $req = $this->connexion->getConnextion()->prepare($query);
        $req->execute() or die('SQL');
    }

  public function delete($id) {
        $query = "DELETE FROM position WHERE id = ?";
        $stmt = $this->connexion->getConnexion()->prepare($query);
        $stmt->execute([$id]);
    }

    public function getAll() {
        $positions = [];
        $query = "SELECT * FROM position";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();

        while ($p = $req->fetch(PDO::FETCH_OBJ)) {
            $positions[] = new Position($p->id, $p->latitude, $p->longitude, $p->date, $p->imei);
        }

        return $positions;
    }

    public function getById($id) {
        $query = "SELECT * FROM position WHERE id = ?";
        $stmt = $this->connexion->getConnexion()->prepare($query);
        $stmt->execute([$id]);
        $p = $stmt->fetch(PDO::FETCH_OBJ);
        if ($p) {
            return new Position($p->id, $p->latitude, $p->longitude, $p->date, $p->imei);
        }
        return null;
    }

    public function update($position) {
        $query = "UPDATE position SET latitude = ?, longitude = ?, date = ?, imei = ? WHERE id = ?";
        $stmt = $this->connexion->getConnexion()->prepare($query);
        $stmt->execute([
            $position->getLatitude(),
            $position->getLongitude(),
            $position->getDate(),
            $position->getImei(),
            $position->getId()
        ]);
    }

    public function findAll() {
    $positions = [];
    $query = "SELECT * FROM position";
    $req = $this->connexion->getConnexion()->prepare($query);
    $req->execute();

    while ($p = $req->fetch(PDO::FETCH_OBJ)) {
        $positions[] = new Position(
            $p->id,
            $p->latitude,
            $p->longitude,
            $p->date,
            $p->imei
        );
    }

    return $positions;
}

    public function findById($id) {
    $query = "SELECT * FROM position WHERE id = ?";
    $stmt = $this->connexion->getConnexion()->prepare($query);
    $stmt->execute([$id]);

    $p = $stmt->fetch(PDO::FETCH_OBJ);
    if ($p) {
        return new Position($p->id, $p->latitude, $p->longitude, $p->date, $p->imei);
    }

    return null;
}


}
