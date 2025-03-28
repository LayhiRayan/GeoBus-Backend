<?php

class LigneBus {

    private $id;
    private $code;

    public function __construct($id, $code) {
        $this->id = $id;
        $this->code = $code;
    }

    public function getId() {
        return $this->id;
    }

    public function getCode() {
        return $this->code;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setCode($code) {
        $this->code = $code;
    }

    public function __toString() {
        $id = isset($this->id) ? $this->id : "Not Assigned";
        return "Ligne Bus ID: " . $id . ", Code: " . $this->code;
    }

}
