<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/BusService.php';
    include_once RACINE . '/service/TrajetService.php';
    create();
}

function create() {
    extract($_POST);

    if (!isset($bus_id, $heureDepart, $heureArrivee, $itineraire)) {
        die("Erreur : Données POST incomplètes !");
    }

    $busService = new BusService();
    $bus = $busService->findById($bus_id);

    if (!$bus) {
        die("Erreur : Bus introuvable !");
    }

    // Create trajet
    $trajet = new Trajet(null, $heureDepart, $heureArrivee, $itineraire, $bus);
    $ts = new TrajetService();
    $ts->createTrajet($trajet);

    echo "Trajet créé avec succès !";
    
}
