<?php
include_once '../racine.php';

require_once RACINE . '/service/CoordonneesService.php';
require_once RACINE . '/classes/Coordonnees.php';

$date = isset($_POST['date']) ? $_POST['date'] : null;

echo "Received date: " . $date . "<br>";

if ($date) {
    $coordonneesService = new CoordonneesService();
    $coordonnees = new Coordonnees(null, $date);
    $coordonneesService->createCoordonnees($coordonnees);

    echo "✅ Coordonnées ajoutées avec succès!";
    header("Location: ../index.php");
    exit();
} else {
    echo "⚠️ Erreur: La date est manquante!";
}
?>
