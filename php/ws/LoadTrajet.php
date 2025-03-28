<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header("Content-Type: application/json");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/TrajetService.php';
    loadAll();
} else {
    echo json_encode([
        "error" => true,
        "message" => "Méthode non autorisée. Utilisez POST."
    ]);
}

function loadAll()
{
    $trajetService = new TrajetService();
    echo json_encode($trajetService->findAllApi());
}
