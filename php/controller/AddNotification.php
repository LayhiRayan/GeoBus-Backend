<?php
include_once '../racine.php';

require_once RACINE . '/service/NotificationService.php';
require_once RACINE . '/classes/Notification.php';
require_once RACINE . '/classes/Usager.php';

if (!isset($_POST['message']) || empty(trim($_POST['message']))) {
    die("⚠️ Erreur: Le message est obligatoire!");
}

if (!isset($_POST['usager_id']) || !is_numeric($_POST['usager_id'])) {
    die("⚠️ Erreur: L'ID de l'usager est invalide!");
}

$message = trim($_POST['message']);
$usager_id = intval($_POST['usager_id']);

$usager = new Usager($usager_id, "", "", "", "");
$notificationService = new NotificationService();
$notification = new Notification(null, $message, $usager);
$notificationService->createNotification($notification);

header("Location: ../index.php");
exit();


?>
