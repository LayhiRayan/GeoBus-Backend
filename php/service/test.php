<?php
// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Define RACINE before using it
define('RACINE', realpath(__DIR__ . '/..')); // Move up one level

// Include necessary files
require_once RACINE . '/service/BusService.php';
require_once RACINE . '/classes/Bus.php';

class BusServiceTest {
    private $busService;

    public function __construct() {
        echo "Initializing BusServiceTest...\n";
        $this->busService = new BusService();
        echo "BusService initialized successfully.\n";
    }

    public function testFindAll() {
        echo "Testing findAll()...\n";
        $buses = $this->busService->findAll();
        echo "Result: " . print_r($buses, true) . "\n";
    }

    public function testFindAllApi() {
        echo "Testing findAllApi()...\n";
        $buses = $this->busService->findAllApi();
        echo "API Result: " . json_encode($buses, JSON_PRETTY_PRINT) . "\n";
    }

    public function testCreate() {
        echo "Testing create()...\n";
        $bus = new Bus(null, "123ABC", "Available");
        $this->busService->create($bus);
        echo "Bus created successfully.\n";
    }
}

// Run tests
$test = new BusServiceTest();
$test->testFindAll(); // Test findAll()
$test->testFindAllApi(); // Test findAllApi()
// $test->testCreate(); // Uncomment if you want to insert a new bus
?>
