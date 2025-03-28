<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/LigneBusService.php';
    include_once RACINE . '/classes/LigneBus.php';
    create();
}

function create()
{
    extract($_POST); // Extracts form data directly

    $ligneBusService = new LigneBusService();
    $ligneBus = new LigneBus(null, $code);
    $ligneBusService->createLigneBus($ligneBus);
}
?>
