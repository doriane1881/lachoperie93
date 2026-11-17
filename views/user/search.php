<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h2>Résultats de recherche</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (isset($products) && !empty($products)): ?>
        <div class="products">
            <?php foreach ($products as $product): ?>
                <div class="product">
                    <img src="<?php echo htmlspecialchars(assetUrl($product['image_path'])); ?>"
                         alt="<?php echo htmlspecialchars($product['name']); ?>"
                         width="200">

                    <h3><?php echo htmlspecialchars($product['name']); ?></h3>
                    <p><?php echo htmlspecialchars($product['description']); ?></p>
                    <p>Prix : <?php echo htmlspecialchars($product['price']); ?> €</p>
                    <p>Catégorie : <?php echo htmlspecialchars($product['category_name']); ?></p>

                    <a href="index.php?controller=product&action=show&id=<?php echo $product['id']; ?>">
                        Détails
                    </a>
                </div>
            <?php endforeach; ?>
        </div>
    <?php elseif (isset($products)): ?>
        <p>Aucun produit trouvé.</p>
    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>
