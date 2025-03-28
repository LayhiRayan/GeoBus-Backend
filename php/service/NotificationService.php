<?php

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Notification.php';
require_once RACINE . '/service/UsagerService.php';

class NotificationService {

    private $connexion;

    public function __construct() {
        $this->connexion = new Connexion();
    }

    public function createNotification(Notification $notif) {
        $stmt = $this->connexion->getConnexion()->prepare("INSERT INTO notification (message, usager_id) VALUES (?, ?)");
        $stmt->execute([$notif->getMessage(), $notif->getUsager()->getId()]);
    }

    public function deleteNotification($id) {
        $stmt = $this->connexion->getConnexion()->prepare("DELETE FROM notification WHERE id = ?");
        $stmt->execute([$id]);
    }

    public function getAllNotifications() {
        try {
            $stmt = $this->connexion->getConnexion()->query("SELECT n.id, n.message, ut.id AS usager_id, ut.nom, ut.prenom, ut.email
                FROM notification n
                INNER JOIN usager u ON n.usager_id = u.id
                INNER JOIN utilisateur ut ON u.id = ut.id");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die("Erreur lors de la récupération des notifications : " . $e->getMessage());
        }
    }

    public function findAllApi() {
        $query = "SELECT * FROM notification";
        $req = $this->connexion->getConnexion()->prepare($query);
        $req->execute();
        return $req->fetchAll(PDO::FETCH_ASSOC);
    }
}
