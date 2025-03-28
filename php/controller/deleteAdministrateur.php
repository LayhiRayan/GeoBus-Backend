<?php
include_once '../racine.php';

require_once RACINE . '/service/AdministrateurService.php';

extract($_GET);

$adminService = new AdministrateurService();
$adminService->deleteAdministrateur($id);

header("Location: ../index.php");
exit();
?>
