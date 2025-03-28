<?php

class Connexion {

    private $connexion;

    public function __construct() {
        $host = 'localhost';
        $dbname = 'bus';
        $login = 'root';
        $password = '';

        try {
            $this->connexion = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $login, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]);
        } catch (PDOException $e) {
            die('Erreur de connexion à la base de données : ' . $e->getMessage());
        }
    }

    public function getConnexion() {
        return $this->connexion;
    }

}
