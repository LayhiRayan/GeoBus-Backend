<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/BusService.php';
    include_once RACINE . '/classes/Bus.php';
    create();
}

function create()
{
    extract($_POST); // Extracts form data directly

    $busService = new BusService();
    $bus = new Bus(null, $matricule, $etat);
    $busService->create($bus);
}
?>
