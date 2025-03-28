<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/CoordonneesService.php';
    loadAll();
}

function loadAll()
{
    $coordonneesService = new CoordonneesService();
    header('Content-Type: application/json');

    echo json_encode($coordonneesService->findAllApi());
}
?>
