<?php
include_once '../racine.php';

require_once RACINE . '/service/NotificationService.php';

extract($_GET);

$notificationService = new NotificationService();
$notificationService->deleteNotification($id);

header("Location: ../index.php");
exit();
?>
