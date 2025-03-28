<?php
include_once '../racine.php';

require_once RACINE . '/service/ArretService.php';

extract($_GET);

$arretService = new ArretService();
$arretService->deleteArret($id);

header("Location: ../index.php");
exit();
?>
