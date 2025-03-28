<?php
include_once '../racine.php';

require_once RACINE . '/service/AdministrateurService.php';
require_once RACINE . '/classes/Administrateur.php';

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['motDePasse'])) {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $email = $_POST['email'];
    $motDePasse = $_POST['motDePasse'];

    $adminService = new AdministrateurService();
    $admin = new Administrateur(null, $nom, $prenom, $email, $motDePasse);
    $adminService->create($admin);

    header("Location: ../index.php");
    exit();
} else {
    die("Error: Missing required fields! Please fill in all the fields.");
}
?>
