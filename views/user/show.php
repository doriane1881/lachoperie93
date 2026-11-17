<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h2>Détail du produit</h2>

    <div class="product-detail">
        <img src="<?php echo htmlspecialchars(assetUrl($product['image_path'])); ?>"
             alt="<?php echo htmlspecialchars($product['name']); ?>"
             width="300">

        <h3><?php echo htmlspecialchars($product['name']); ?></h3>

        <p><?php echo htmlspecialchars($product['description']); ?></p>

        <p><strong>Prix :</strong> <?php echo htmlspecialchars($product['price']); ?> €</p>

        <p><strong>Catégorie :</strong> <?php echo htmlspecialchars($product['category_name']); ?></p>

        <a href="index.php?controller=cart&action=add&id=<?php echo $product['id']; ?>">
            Ajouter au panier
        </a>

        <a href="index.php">Retour à l'accueil</a>
    </div>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
