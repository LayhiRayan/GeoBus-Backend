<?php
require_once RACINE . '/classes/Utilisateur.php';


class Administrateur extends Utilisateur {

    public function __construct($id, $nom, $prenom, $email, $motDePasse) {
        parent::__construct($id, $nom, $prenom, $email, $motDePasse);
    }

    public function resetMotDePasse($nouveauMotDePasse) {
        $this->setMotDePasse($nouveauMotDePasse);
    }

    public function __toString() {
        return parent::__toString() . " (Administrateur)";
    }

}
