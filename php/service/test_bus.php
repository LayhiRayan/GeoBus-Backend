<?php
require_once '../service/BusService.php';

// Instanciation du service
$busService = new BusService();

// 🔹 Tester `create()`
$newBus = new Bus(null, "TEST1234", "Bon état");
$busService->create($newBus);
echo "Bus ajouté avec succès ! <br>";

// 🔹 Tester `findAll()`
$buses = $busService->findAll();
echo "<pre>";
print_r($buses);
echo "</pre>";

// 🔹 Tester `findById()`
$bus = $busService->findById(1);
if ($bus) {
    echo "Bus trouvé : " . $bus->getMatricule() . "<br>";
} else {
    echo "Aucun bus trouvé avec cet ID.<br>";
}

// 🔹 Tester `update()`
if ($bus) {
    $bus->setEtat("Réparé");
    $busService->update($bus);
    echo "Mise à jour réussie !<br>";
}

// 🔹 Tester `delete()`
$busService->delete(2); // ID de test
echo "Bus supprimé avec succès !<br>";
?>
