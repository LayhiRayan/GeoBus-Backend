<?php

require_once RACINE . '/classes/LigneBus.php';

class Arret {

    private $id;
    private $coordonnees;
    private $longitude;
    private $latitude;
    private $ligneBus;

    public function __construct($id, $coordonnees, $longitude, $latitude, $ligneBus) {
        $this->id = $id;
        $this->coordonnees = $coordonnees;
        $this->longitude = $longitude;
        $this->latitude = $latitude;
        $this->ligneBus = $ligneBus;
    }

    public function getId() {
        return $this->id;
    }

    public function getCoordonnees() {
        return $this->coordonnees;
    }

    public function getLongitude() {
        return $this->longitude;
    }

    public function getLatitude() {
        return $this->latitude;
    }

    public function getLigneBus() {
        return $this->ligneBus;
    }

    
    public function setId($id) {
        $this->id = $id;
    }

    public function setCoordonnees($coordonnees) {
        $this->coordonnees = $coordonnees;
    }

    public function setLongitude($longitude) {
        $this->longitude = $longitude;
    }

    public function setLatitude($latitude) {
        $this->latitude = $latitude;
    }

    public function setLigneBus($ligneBus) {
        $this->ligneBus = $ligneBus;
    }

}

?>
