<?php

class Bus {

    private $id;
    private $matricule;
    private $etat;
    private $ligne_id;

    public function __construct($id, $matricule, $etat, $ligne_id = null) {
        $this->id = $id;
        $this->matricule = $matricule;
        $this->etat = $etat;
        $this->ligne_id = $ligne_id;
    }

    public function getId() {
        return $this->id;
    }

    public function getMatricule() {
        return $this->matricule;
    }

    public function getEtat() {
        return $this->etat;
    }

    public function getLigneId() {
        return $this->ligne_id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMatricule($matricule) {
        $this->matricule = $matricule;
    }

    public function setEtat($etat) {
        $this->etat = $etat;
    }

    public function setLigneId($ligne_id) {
        $this->ligne_id = $ligne_id;
    }

    public function __toString() {
        $id = isset($this->id) ? $this->id : "Not Assigned";
        $ligne = isset($this->ligne_id) ? $this->ligne_id : "Non affecté";
        return "Bus ID: " . $id . ", Matricule: " . $this->matricule . ", État: " . $this->etat . ", Ligne: " . $ligne;
    }
}
