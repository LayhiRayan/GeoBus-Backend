<?php
header("Access-Control-Allow-Origin: *");
header('Content-Type: application/json');

include_once '../racine.php';
include_once RACINE . '/service/ArretService.php';
include_once RACINE . '/service/BusService.php';
include_once RACINE . '/service/LigneBusService.php';
include_once RACINE . '/service/TrajetService.php';

$arretService = new ArretService();
$busService = new BusService();
$ligneService = new LigneBusService();
$trajetService = new TrajetService();

// On suppose que findAllApi() retourne un tableau
echo json_encode([
    "bus" => count($busService->findAllApi()),
    "lignes" => count($ligneService->findAllApi()),
    "arrets" => count($arretService->findAllApi()),
    "trajets" => count($trajetService->findAllApi())
]);
