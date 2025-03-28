<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/UsagerService.php';
    loadAll();
}

function loadAll()
{
    $usagerService = new UsagerService();
    header('Content-Type: application/json');

    echo json_encode($usagerService->findAllApi());
}
?>
