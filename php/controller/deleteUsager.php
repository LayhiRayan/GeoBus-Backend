<?php
include_once '../racine.php';

require_once RACINE . '/service/UsagerService.php';

extract($_GET);

$usagerService = new UsagerService();
$usagerService->deleteUsager($id);

header("Location: ../index.php");
exit();
?>
