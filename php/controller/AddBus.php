<?php

include_once '../racine.php';
require_once RACINE . '/connexion/Connexion.php';

$connexionInstance = new Connexion();
$conn = $connexionInstance->getConnexion();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $matricule = isset($_POST['matricule']) ? $_POST['matricule'] : null;
    $etat = isset($_POST['etat']) ? $_POST['etat'] : null;

    if (!empty($matricule) && !empty($etat)) {
        try {
            $query = "INSERT INTO bus (matricule, etat) VALUES (:matricule, :etat)";
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':matricule', $matricule);
            $stmt->bindParam(':etat', $etat);

            if ($stmt->execute()) {
                // Redirection vers la page principale après l'ajout
                header("Location: ../index.php");
                exit();
            } else {
                echo "❌ Erreur lors de l'ajout du bus.";
            }
        } catch (PDOException $e) {
            echo "❌ Erreur PDO : " . $e->getMessage();
        }
    } else {
        echo "⚠️ Données manquantes!";
    }
} else {
    echo "🚫 Requête invalide.";
}
?>
