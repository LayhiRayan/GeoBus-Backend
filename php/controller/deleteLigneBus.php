<?php
include_once '../racine.php';

require_once RACINE . '/service/LigneBusService.php';

extract($_GET);

$ligneBusService = new LigneBusService();
$ligneBusService->deleteLigneBus($id);

header("Location: ../index.php");
exit();
?>
