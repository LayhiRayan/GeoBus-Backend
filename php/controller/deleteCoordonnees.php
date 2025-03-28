<?php
include_once '../racine.php';

require_once RACINE . '/service/CoordonneesService.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $coordonneesService = new CoordonneesService();
    $coordonneesService->deleteCoordonnees($id);

    header("Location: ../index.php"); 
    exit();
} else {
    echo "⚠️ Erreur: ID non spécifié!";
}
?>
