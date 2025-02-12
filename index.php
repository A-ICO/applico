<?php
// index.php
session_start();

require_once 'config/database.php';
require_once 'models/User.php';
require_once 'controllers/AuthController.php';
require_once 'controllers/UserController.php';

$action = $_GET['action'] ?? 'login';

switch($action) {
    case 'login':
        $controller = new AuthController();
        $controller->login();
        break;
        
    case 'register':
        $controller = new UserController();
        $controller->register();
        break;
        
    case 'home':
        if(!isset($_SESSION['user'])) {
            header("Location: index.php?action=login");
            exit;
        }
        include 'views/home.php';
        break;
        
        case 'cancel':
            $controller = new AuthController();
            $controller->cancel();
            break;
            
    case 'logout':
        session_destroy();
        header("Location: index.php?action=login");
        exit;
        
    default:
        header("Location: index.php?action=login");
        exit;
}