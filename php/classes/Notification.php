<?php

require_once RACINE . '/classes/Usager.php';

class Notification {

    private $id;
    private $message;
    private $usager;

    public function __construct($id, $message, Usager $usager) {
        $this->id = $id;
        $this->message = $message;
        $this->usager = $usager;
    }

    public function getId() {
        return $this->id;
    }

    public function getMessage() {
        return $this->message;
    }

    public function getUsager() {
        return $this->usager;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setUsager(Usager $usager) {
        $this->usager = $usager;
    }

    public function __toString() {
        $id = isset($this->id) ? $this->id : "Not Assigned";
        $usagerId = isset($this->usager) && method_exists($this->usager, 'getId') && $this->usager->getId() !== null ? $this->usager->getId() : "Not Assigned";

        return "Notification ID: " . $id .
               ", Message: " . $this->message .
               ", Usager ID: " . $usagerId;
    }

}
