<?php
// index.php
require_once 'vendor/autoload.php';
require_once 'config/database.php';
require_once 'app/controllers/MainController.php';

// Simple Router
$action = isset($_GET['action']) ? $_GET['action'] : 'dashboard';

$controller = new MainController();

switch ($action) {
    case 'dashboard':
        $controller->dashboard();
        break;
    case 'timeline':
        $controller->timeline();
        break;
    case 'import':
        $controller->import();
        break;
    default:
        $controller->dashboard();
        break;
}
?>
