<?php
require_once __DIR__ . '/../racine.php';  // Include racine.php

require_once RACINE . '/dao/IDao.php';
require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/classes/Bus.php';
require_once RACINE . '/service/BusService.php';

header('Content-Type: application/json');

$busService = new BusService();
echo json_encode($busService->findAllApi());
?>
