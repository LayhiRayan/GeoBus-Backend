<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/ArretService.php';
    include_once RACINE . '/classes/Arret.php';
    include_once RACINE . '/classes/LigneBus.php';
    create();
}

function create()
{
    if (!isset($_POST['ligne_id'], $_POST['coordonnees'], $_POST['longitude'], $_POST['latitude'])) {
        die("Erreur : Données POST incomplètes !");
    }

    $coordonnees = $_POST['coordonnees'];
    $longitude = $_POST['longitude'];
    $latitude = $_POST['latitude'];
    $ligne_id = $_POST['ligne_id'];

    $ligneBus = new LigneBus($ligne_id, "");
    $arret = new Arret(null, $coordonnees, $longitude, $latitude, $ligneBus);

    $arretService = new ArretService();
    $arretService->create($arret);

    echo json_encode(["success" => true]);
}
?>
