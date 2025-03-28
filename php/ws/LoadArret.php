<?php
header("Access-Control-Allow-Origin: *");
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/ArretService.php';
    loadAll();
}

function loadAll()
{
    $arretService = new ArretService();
    header('Content-Type: application/json');

    echo json_encode($arretService->findAllApi());
}
?>
