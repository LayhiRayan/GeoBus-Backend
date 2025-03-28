<?php
include_once '../racine.php';

require_once RACINE . '/service/TrajetService.php';
require_once RACINE . '/service/BusService.php';
require_once RACINE . '/classes/Trajet.php';

$heureDepart = $_POST['heureDepart'];
$heureArrivee = $_POST['heureArrivee'];
$itineraire = $_POST['itineraire'];
$bus_id = $_POST['bus']; 

$busService = new BusService();
$bus = $busService->findById($bus_id); 

if (!$bus) {
    die("Erreur: Le bus avec l'ID $bus_id n'existe pas.");
}

$trajet = new Trajet(null, $heureDepart, $heureArrivee, $itineraire, $bus);

$trajetService = new TrajetService();
$trajetService->createTrajet($trajet);

// Redirection vers la page principale après l'ajout
header("Location: ../index.php");
exit();

?>
