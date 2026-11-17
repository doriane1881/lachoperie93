<?php
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../models/Product.php';

class ProductController
{
    public function index()
    {
        global $pdo;

        $products = getAllProducts($pdo);

        require_once __DIR__ . '/../views/home/home.php';
    }

    public function add()
    {
        global $pdo;
        $error = '';

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit();
        }

        if ($_SESSION['role'] !== 'vendeur') {
            $error = "Accès refusé. Cette page est réservée aux vendeurs.";
            require_once __DIR__ . '/../views/user/add_product.php';
            exit();
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name'] ?? '');
            $description = trim($_POST['description'] ?? '');
            $price = trim($_POST['price'] ?? '');
            $categoryId = $_POST['category_id'] ?? '';

            if ($name === '' || $description === '' || $price === '' || $categoryId === '') {
                $error = "Tous les champs sont obligatoires.";
                require_once __DIR__ . '/../views/user/add_product.php';
                exit();
            }

            if (!is_numeric($price) || $price <= 0) {
                $error = "Le prix doit être un nombre valide.";
                require_once __DIR__ . '/../views/user/add_product.php';
                exit();
            }

            if (!isset($_FILES['image']) || $_FILES['image']['error'] !== 0) {
    $error = "Veuillez sélectionner une image.";
    require_once __DIR__ . '/../views/product/add_product.php';
    exit();
}

$allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];
$fileName = $_FILES['image']['name'];
$fileTmpName = $_FILES['image']['tmp_name'];
$fileSize = $_FILES['image']['size'];
$extension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

if (!in_array($extension, $allowedExtensions)) {
    $error = "Seuls les fichiers JPG, JPEG, PNG et WEBP sont autorisés.";
    require_once __DIR__ . '/../views/product/add_product.php';
    exit();
}

if ($fileSize > 2 * 1024 * 1024) {
    $error = "L'image ne doit pas dépasser 2 Mo.";
    require_once __DIR__ . '/../views/product/add_product.php';
    exit();
}

$uploadDir = __DIR__ . '/../uploads/';

if (!is_dir($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

$newFileName = uniqid('product_', true) . '.' . $extension;
$destination = $uploadDir . $newFileName;

if (move_uploaded_file($fileTmpName, $destination)) {
    $imagePath = 'uploads/' . $newFileName;
} else {
    $error = "Impossible d'enregistrer l'image.";
    require_once __DIR__ . '/../views/product/add_product.php';
    exit();
    }

createProduct($pdo, $name, $description, $price, $categoryId, $imagePath);

        header('Location: index.php');
            exit();
}

    require_once __DIR__ . '/../views/user/add_product.php';
    }




public function show()
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

    require_once __DIR__ . '/../views/user/show.php';
}
public function search()
{
    global $pdo;
    $error = '';
    $products = [];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $search = trim($_POST['search'] ?? '');

        if ($search === '') {
            $error = "Veuillez entrer un mot-clé.";
        } elseif (strlen($search) < 2) {
            $error = "La recherche doit contenir au moins 2 caractères.";
        } else {
            $products = searchProducts($pdo, $search);
        }
    }

    require_once __DIR__ . '/../views/user/search.php';
}
}

?>
