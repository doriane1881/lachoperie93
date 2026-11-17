<?php
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../models/Product.php';

class CartController
{
    public function add()
    {
        global $pdo;

        $id = $_GET['id'] ?? null;

        if (!$id || !is_numeric($id)) {
            header('Location: index.php');
            exit();
        }

        $product = getProductById($pdo, $id);

        if (!$product) {
            header('Location: index.php');
            exit();
        }

        if (!isset($_SESSION['cart'])) {
            $_SESSION['cart'] = [];
        }

        $productId = $product['id'];

        if (isset($_SESSION['cart'][$productId])) {
            $_SESSION['cart'][$productId]['quantity']++;
        } else {
            $_SESSION['cart'][$productId] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image_path' => $product['image_path'],
                'quantity' => 1
            ];
        }

        header('Location: index.php?controller=cart&action=view');
        exit();
    }

    public function view()
    {
        $cart = $_SESSION['cart'] ?? [];
        require_once __DIR__ . '/../views/cart/view.php';
    }
    
    public function remove()
{
    $id = $_GET['id'] ?? null;

    if ($id && isset($_SESSION['cart'][$id])) {

        if ($_SESSION['cart'][$id]['quantity'] > 1) {
            $_SESSION['cart'][$id]['quantity']--;
        } else {
            unset($_SESSION['cart'][$id]);
        }
    }

    header('Location: index.php?controller=cart&action=view');
    exit();
}
}
?>
