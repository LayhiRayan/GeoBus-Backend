<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/TrajetService.php';

    if (!isset($_POST["id"])) {
        http_response_code(400);
        echo json_encode(["error" => "ID du trajet manquant"]);
        exit;
    }

    $id = $_POST["id"];
    $trajetService = new TrajetService();
    $trajetService->deleteTrajet($id);

    echo json_encode(["success" => true, "message" => "Trajet supprimé avec succès"]);
}
