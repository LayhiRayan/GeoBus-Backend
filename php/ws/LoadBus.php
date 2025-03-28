<?php

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");
header("Content-Type: application/json");
// ton code ici...

error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once('../service/BusService.php');

$busService = new BusService();
$buses = $busService->findAllApi();

header('Content-Type: application/json');
echo json_encode($buses);
