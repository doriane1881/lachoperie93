<?php
require_once __DIR__ . '/config/runtime.php';
session_start();

require_once __DIR__ . '/controllers/UserController.php';
require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/CartController.php';

$controller = $_GET['controller'] ?? 'home';
$action = $_GET['action'] ?? 'index';

switch ($controller) {

    case 'home':
        $productController = new ProductController();
        $productController->index();
        break;

    case 'user':
        $userController = new UserController();

        switch ($action) {
            case 'login':
                $userController->login();
                break;

            case 'register':
                $userController->register();
                break;

            case 'profile':
                $userController->profile();
                break;

            case 'logout':
                $userController->logout();
                break;

            default:
                echo "Action utilisateur inconnue.";
                break;
        }
        break;

    case 'product':
    $productController = new ProductController();

    switch ($action) {
        case 'add':
            $productController->add();
            break;

        case 'show':
            $productController->show();
            break;
        case 'search':
    $productController->search();
    break;

        default:
            echo "Action produit inconnue.";
            break;
    }
    break;
        case 'cart':
    $cartController = new CartController();

    switch ($action) {
        case 'add':
            $cartController->add();
            break;

        case 'view':
            $cartController->view();
            break;

        case 'remove':
            $cartController->remove();
            break;

        default:
            echo "Action panier inconnue.";
            break;
    }
    break;

    default:
        echo "Controller inconnu.";
        break;
}
?>
