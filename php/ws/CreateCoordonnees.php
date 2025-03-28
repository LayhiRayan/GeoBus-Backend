<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/CoordonneesService.php';
    include_once RACINE . '/classes/Coordonnees.php';
    create();
}

function create()
{
    extract($_POST);

    $coordonneesService = new CoordonneesService();
    $coordonneesService->createCoordonnees(new Coordonnees(null, $date));
}
?>
