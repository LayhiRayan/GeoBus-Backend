<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/UsagerService.php';
    include_once RACINE . '/classes/Usager.php';
    create();
}

function create()
{
    extract($_POST);

    $usagerService = new UsagerService();
    $usagerService->createUsager(new Usager(null, $nom, $prenom, $email, $motDePasse));
}
?>
