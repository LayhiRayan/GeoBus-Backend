<?php
include_once '../racine.php';

require_once RACINE . '/service/UsagerService.php';
require_once RACINE . '/classes/Usager.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        isset($_POST['nom']) && 
        isset($_POST['prenom']) && 
        isset($_POST['email']) && 
        isset($_POST['motDePasse'])
    ) {
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $motDePasse = trim($_POST['motDePasse']);

        if ($nom === "" || $prenom === "" || $email === "" || $motDePasse === "") {
            die("Erreur: Tous les champs sont obligatoires.");
        }

        $usager = new Usager(null, $nom, $prenom, $email, $motDePasse);

        $usagerService = new UsagerService();
        $usagerService->createUsager($usager);

        header("Location: ../index.php");
        exit();
    } else {
        die("Erreur: Tous les champs sont requis.");
    }
} else {
    die("Méthode non autorisée.");
}
