<?php
require_once __DIR__ . '/classes/Utilisateur.php'; // Adjust path if needed

// Create a new Utilisateur instance
$user = new Utilisateur(null, "Doe", "John", "john@example.com", "securepassword");

// Display user information
echo $user;
?>
