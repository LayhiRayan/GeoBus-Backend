<?php
include_once '../racine.php';

require_once RACINE . '/service/TrajetService.php';

extract($_GET);

$trajetService = new TrajetService();
$trajetService->deleteTrajet($id);

header("Location: ../index.php");
exit();
?>
