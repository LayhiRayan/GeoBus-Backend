<?php

class Utilisateur {

    protected $id;
    protected $nom;
    protected $prenom;
    protected $email;
    protected $motDePasse;

    public function __construct($id, $nom, $prenom, $email, $motDePasse) {
        if ($id !== null && (!is_int($id) || $id <= 0)) {
            throw new InvalidArgumentException("L'ID doit être un entier positif.");
        }
        if (!is_string($nom) || !is_string($prenom) || !is_string($email) || !is_string($motDePasse)) {
            throw new InvalidArgumentException("Les champs nom, prénom, email et mot de passe doivent être des chaînes de caractères.");
        }

        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->motDePasse = $motDePasse;
    }

    public function getId() {
        return $this->id;
    }

    public function getNom() {
        return $this->nom;
    }

    public function getPrenom() {
        return $this->prenom;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getMotDePasse() {
        return $this->motDePasse;
    }

    public function setId($id) {
        if ($id !== null && (!is_int($id) || $id <= 0)) {
            throw new InvalidArgumentException("L'ID doit être un entier positif.");
        }
        $this->id = $id;
    }

    public function setNom($nom) {
        if (!is_string($nom)) {
            throw new InvalidArgumentException("Le nom doit être une chaîne de caractères.");
        }
        $this->nom = $nom;
    }

    public function setPrenom($prenom) {
        if (!is_string($prenom)) {
            throw new InvalidArgumentException("Le prénom doit être une chaîne de caractères.");
        }
        $this->prenom = $prenom;
    }

    public function setEmail($email) {
        if (!is_string($email)) {
            throw new InvalidArgumentException("L'email doit être une chaîne de caractères.");
        }
        $this->email = $email;
    }

    public function setMotDePasse($motDePasse) {
        if (!is_string($motDePasse)) {
            throw new InvalidArgumentException("Le mot de passe doit être une chaîne de caractères.");
        }
        $this->motDePasse = $motDePasse;
    }

    public function __toString() {
        return "ID: " . ($this->id !== null ? $this->id : "Non assigné") .
                ", Nom: " . $this->nom .
                ", Prénom: " . $this->prenom .
                ", Email: " . $this->email;
    }

}
