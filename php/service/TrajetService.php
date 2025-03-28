<?php

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Trajet.php';
require_once RACINE . '/service/BusService.php';

class TrajetService {

    private $connexion;
    private $busService;

    public function __construct() {
        $this->connexion = new Connexion();
        $this->busService = new BusService();
    }

    // ✅ Ajouter un trajet
    public function createTrajet($trajet) {
        $sql = "INSERT INTO trajet (heureDepart, heureArrivee, ligne_id, bus_id, itineraire) 
                VALUES (:heureDepart, :heureArrivee, :ligne_id, :bus_id, :itineraire)";

        $stmt = $this->connexion->getConnexion()->prepare($sql);
        $stmt->execute([
            ':heureDepart' => $trajet->getHeureDepart(),
            ':heureArrivee' => $trajet->getHeureArrivee(),
            ':ligne_id' => $trajet->getLigneId(),
            ':bus_id' => $trajet->getBus()->getId(),
            ':itineraire' => $trajet->getItineraire()
        ]);
    }

    public function findAll() {
        $query = "SELECT * FROM trajet";
        $stmt = $this->connexion->getConnexion()->prepare($query);
        $stmt->execute();
        $result = [];

        while ($row = $stmt->fetch(PDO::FETCH_OBJ)) {
            $bus = $this->busService->findById($row->bus_id);
            if ($bus) {
                $trajet = new Trajet(
                    $row->id,
                    $row->heureDepart,
                    $row->heureArrivee,
                    $row->ligne_id,
                    $row->itineraire,
                    $bus
                );
                $result[] = $trajet;
            }
        }

        return $result;
    }

    // ✅ Supprimer un trajet
    public function deleteTrajet($id) {
        $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM trajet WHERE id = ?");
        $stmt->execute([$id]);
    }

    // ✅ Récupérer tous les trajets avec lignes et bus
    public function findAllApi() {
        $query = "SELECT t.id, t.heureDepart, t.heureArrivee, t.itineraire,
                         b.id AS bus_id, b.matricule,
                         l.id AS ligne_id, l.code AS ligne_code
                  FROM trajet t
                  JOIN bus b ON t.bus_id = b.id
                  JOIN lignebus l ON t.ligne_id = l.id";

        $stmt = $this->connexion->getConnexion()->prepare($query);
        $stmt->execute();

        $results = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $results[] = [
                "id" => $row["id"],
                "heureDepart" => $row["heureDepart"],
                "heureArrivee" => $row["heureArrivee"],
                "itineraire" => $row["itineraire"],
                "bus" => [
                    "id" => $row["bus_id"],
                    "matricule" => $row["matricule"]
                ],
                "ligne" => [
                    "id" => $row["ligne_id"],
                    "code" => $row["ligne_code"]
                ]
            ];
        }

        return $results;
    }

    public function getTrajetsDuJour() {
        $stmt = $this->connexion->getConnexion()->prepare("SELECT * FROM trajet WHERE DATE(heureDepart) = CURDATE()");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}