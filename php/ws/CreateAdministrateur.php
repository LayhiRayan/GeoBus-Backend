<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/AdministrateurService.php';
    create();
}

function create() {
    extract($_POST);

    // Validate required fields
    if (!isset($nom, $prenom, $email, $motDePasse) || empty($nom) || empty($prenom) || empty($email) || empty($motDePasse)) {
        die("Erreur: Tous les champs (nom, prénom, email, mot de passe) sont requis.");
    }

    $adminService = new AdministrateurService();
    $adminService->create(new Administrateur(null, $nom, $prenom, $email, $motDePasse));
}
