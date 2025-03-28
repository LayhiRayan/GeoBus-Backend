<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/NotificationService.php';
    include_once RACINE . '/service/UsagerService.php';

    // Récupération des données envoyées en JSON
    $data = json_decode(file_get_contents("php://input"), true);

    // Vérifie si les champs requis sont présents
    if (!isset($data['message']) || !isset($data['usager_id'])) {
        http_response_code(400);
        echo json_encode(['error' => 'Champs requis manquants']);
        exit;
    }

    $message = $data['message'];
    $usagerId = $data['usager_id'];

    try {
        // Récupération de l'usager
        $usagerService = new UsagerService();
        $usager = $usagerService->findById($usagerId);

        if (!$usager) {
            http_response_code(404);
            echo json_encode(['error' => 'Usager introuvable']);
            exit;
        }

        // Création de l'objet Notification
        $notif = new Notification(
            null,            // ID (auto-incrémenté)
            $message,        // message
            null,            // type (ex: "retard", "batterie", etc.) — à compléter plus tard
            null,            // date de création (utilisée par MySQL automatiquement)
            false,           // lu = false (par défaut)
            $usager,         // objet Usager
            null             // bus (optionnel)
        );

        // Enregistrement de la notification
        $notifService = new NotificationService();
        $notifService->createNotification($notif);

        echo json_encode(['success' => 'Notification créée avec succès']);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(['error' => 'Erreur serveur : ' . $e->getMessage()]);
    }
}
?>
