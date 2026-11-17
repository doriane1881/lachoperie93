<?php

function getAllProducts($pdo)
{
    $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            ORDER BY products.id DESC";

    $stmt = $pdo->prepare($sql);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
function createProduct($pdo, $name, $description, $price, $categoryId, $imagePath)
{
    $sql = "INSERT INTO products (name, description, price, category_id, image_path)
            VALUES (?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$name, $description, $price, $categoryId, $imagePath]);
}
function getProductById($pdo, $id)
{
    $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE products.id = ?";

    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
function searchProducts($pdo, $search)
{
    $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            INNER JOIN categories ON products.category_id = categories.id
            WHERE products.name LIKE ?
            ORDER BY products.id DESC";

    $stmt = $pdo->prepare($sql);
    $search = "%$search%";
    $stmt->execute([$search]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}