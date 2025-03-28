<?php

require_once RACINE . '/classes/Utilisateur.php';

class Usager extends Utilisateur {

    public function __construct($id, $nom, $prenom, $email, $motDePasse) {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse);
    }

    public function __toString() {
        return parent::__toString() . " (Usager)";
    }

}
