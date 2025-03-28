<?php

require_once RACINE . '/classes/Bus.php';

class Trajet {

    private $id;
    private $heureDepart;
    private $heureArrivee;
    private $itineraire;
    private $bus;
    private $ligneId; // 🆕 nouvelle propriété

    public function __construct($id, $heureDepart, $heureArrivee, $itineraire, Bus $bus, $ligneId) {
        $this->id = $id;
        $this->heureDepart = $heureDepart;
        $this->heureArrivee = $heureArrivee;
        $this->itineraire = $itineraire;
        $this->bus = $bus;
        $this->ligneId = $ligneId;
    }

    // Getters
    public function getId() {
        return $this->id;
    }

    public function getHeureDepart() {
        return $this->heureDepart;
    }

    public function getHeureArrivee() {
        return $this->heureArrivee;
    }

    public function getItineraire() {
        return $this->itineraire;
    }

    public function getBus() {
        return $this->bus;
    }

    public function getLigneId() {
        return $this->ligneId;
    }

    // Setters
    public function setId($id) {
        $this->id = $id;
    }

    public function setHeureDepart($heureDepart) {
        $this->heureDepart = $heureDepart;
    }

    public function setHeureArrivee($heureArrivee) {
        $this->heureArrivee = $heureArrivee;
    }

    public function setItineraire($itineraire) {
        $this->itineraire = $itineraire;
    }

    public function setBus(Bus $bus) {
        $this->bus = $bus;
    }

    public function setLigneId($ligneId) {
        $this->ligneId = $ligneId;
    }

    public function __toString() {
    $id = isset($this->id) ? $this->id : "Not Assigned";
    $busId = isset($this->bus) && method_exists($this->bus, 'getId') ? $this->bus->getId() : "Not Assigned";

    return "Trajet ID: " . $id .
           ", Heure Départ: " . $this->heureDepart .
           ", Heure Arrivée: " . $this->heureArrivee .
           ", Itinéraire: " . $this->itineraire .
           ", Ligne ID: " . $this->ligneId .
           ", Bus ID: " . $busId;
}

}
