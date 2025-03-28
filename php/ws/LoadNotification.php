<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include_once '../racine.php';
    include_once RACINE . '/service/NotificationService.php';

    $data = json_decode(file_get_contents("php://input"), true);
    $usagerId = isset($data['usager_id']) ? $data['usager_id'] : null;

    if (!$usagerId) {
        http_response_code(400);
        echo json_encode(["error" => "ID usager requis"]);
        exit;
    }

    $ns = new NotificationService();
    $notifications = $ns->getNotificationsByUsager($usagerId);
    header('Content-Type: application/json');
    echo json_encode($notifications);
}
?>
