<?php

class Coordonnees {

    private $id;
    private $date;

    public function __construct($id, $date) {
        $this->id = $id;
        $this->date = $date;
    }

    public function getId() {
        return $this->id;
    }

    public function getDate() {
        return $this->date;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setDate($date) {
        $this->date = $date;
    }

    public function __toString() {
        $id = isset($this->id) ? $this->id : "Not Assigned";
        return "Coordonnees ID: " . $id . ", Date: " . $this->date;
    }

}
