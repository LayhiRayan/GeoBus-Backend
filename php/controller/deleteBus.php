
<?php
include_once '../racine.php';

require_once '../service/BusService.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);  

    $busService = new BusService();
    $busService->delete($id); 

    header("Location: ../index.php?message=Bus supprimé avec succès !");
    exit();
} else {
    echo "ID du bus non fourni.";
}
?>
