<?php
include_once '../racine.php';

require_once RACINE . '/connexion/Connexion.php';
require_once RACINE . '/service/ArretService.php';
require_once RACINE . '/classes/Arret.php';
require_once RACINE . '/classes/LigneBus.php';

$success = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $coordonnees = isset($_POST['coordonnees']) ? $_POST['coordonnees'] : null;
    $longitude = isset($_POST['longitude']) ? $_POST['longitude'] : null;
    $latitude = isset($_POST['latitude']) ? $_POST['latitude'] : null;
    $ligne_id = isset($_POST['ligne_id']) ? $_POST['ligne_id'] : null;

    if ($coordonnees && $longitude && $latitude && $ligne_id) {
        $ligneBus = new LigneBus($ligne_id, "Code inconnu");
        $arret = new Arret(null, $coordonnees, $longitude, $latitude, $ligneBus);

        $service = new ArretService();
        $service->create($arret);

        $success = true;
        // Redirect to index.php after adding
        header("Location: ../index.php");
        exit();
    }
}
?>
