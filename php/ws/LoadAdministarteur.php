<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/AdministrateurService.php';
    loadAll();
}

function loadAll()
{
    $adminService = new AdministrateurService();
    header('Content-Type: application/json');

    echo json_encode($adminService->findAllApi());
}
?>
