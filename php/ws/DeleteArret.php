<?php
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/ArretService.php';

    if (!isset($_POST['id'])) {
        http_response_code(400);
        echo json_encode(["success" => false, "message" => "ID manquant"]);
        exit;
    }

    $id = $_POST['id'];

    try {
        $service = new ArretService();
        $service->deleteArret($id);
        echo json_encode(["success" => true, "message" => "Arrêt supprimé avec succès"]);
    } catch (Exception $e) {
        http_response_code(500);
        echo json_encode(["success" => false, "message" => "Erreur : " . $e->getMessage()]);
    }
}
?>
