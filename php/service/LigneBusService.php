<?php

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/LigneBus.php';

class LigneBusService {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function createLigneBus(LigneBus $ligne) {
        try {
            $stmt = $this->connexion->getConnexion()->prepare("INSERT INTO lignebus (code) VALUES (:code)");
            $stmt->bindParam(':code', $ligne->getCode(), PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }

    public function deleteLigneBus($id) {
        try {
            $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM lignebus WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            die("Database Error: " . $e->getMessage());
        }
    }

    public function findAllApi() {
        $query = "SELECT id, code FROM lignebus";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        $lignes = $req->fetchAll(PDO::FETCH_ASSOC);

        foreach ($lignes as &$ligne) {
            $ligne_id = $ligne['id'];

            // ✅ Charger les arrêts
            $arretReq = $this->connexion->getConnexion()->prepare(
"SELECT coordonnees AS nom, latitude, longitude, ligne_id FROM arret WHERE ligne_id = :ligne_id"

            );
            $arretReq->bindParam(':ligne_id', $ligne_id);
            $arretReq->execute();
            $arrets = $arretReq->fetchAll(PDO::FETCH_ASSOC);
            $ligne['arrets'] = $arrets;

            // ✅ Construire les coordonnées
            $coordonnees = array_map(function($a) {
                return [(float)$a['latitude'], (float)$a['longitude']];
            }, $arrets);
            $ligne['coordonnees'] = $coordonnees;

            // ✅ Bus affecté via la table trajet (corrigé)
            $busReq = $this->connexion->getConnexion()->prepare(
                "SELECT b.id, b.matricule
                 FROM bus b
                 INNER JOIN trajet t ON b.id = t.bus_id
                 WHERE t.ligne_id = :ligne_id
                 LIMIT 1"
            );
            $busReq->bindParam(':ligne_id', $ligne_id);
            $busReq->execute();
            $bus = $busReq->fetch(PDO::FETCH_ASSOC);

            $ligne['busAffecte'] = $bus ? [
                "id" => $bus['id'],
                "nom" => $bus['matricule']
            ] : [
                "id" => null,
                "nom" => "Aucun bus"
            ];
        }

        return $lignes;
    }
}
