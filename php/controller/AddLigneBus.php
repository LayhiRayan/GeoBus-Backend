<?php
include_once '../racine.php';
require_once RACINE . '/service/LigneBusService.php';
require_once RACINE . '/classes/LigneBus.php';

if (empty($_GET)) {
    die("Error: No data received.");
}

if (!isset($_GET['code']) || empty(trim($_GET['code']))) {
    die("Error: 'code' parameter is missing or empty.");
}

$code = trim($_GET['code']); 

$ligneBusService = new LigneBusService();
$ligneBus = new LigneBus(null, $code);
$ligneBusService->createLigneBus($ligneBus);

header("Location: ../index.php");
exit();
?>
