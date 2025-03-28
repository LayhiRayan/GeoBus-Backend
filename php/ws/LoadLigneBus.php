<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Allow-Headers: Content-Type");
header('Content-Type: application/json');

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/LigneBusService.php';
    loadAll();
} else {
    echo json_encode([
        "error" => true,
        "message" => "Méthode non autorisée. Utilisez POST."
    ]);
}

function loadAll() {
    $service = new LigneBusService();
    echo json_encode($service->findAllApi());
}
