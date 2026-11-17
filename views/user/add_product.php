<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h2>Ajouter un produit</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <?php if (!isset($_SESSION['user_id'])): ?>
        <p>Vous devez être connecté pour accéder à cette page.</p>

    <?php elseif ($_SESSION['role'] !== 'vendeur'): ?>
        <p>Accès refusé. Cette page est réservée aux vendeurs.</p>

    <?php else: ?>

        <form action="index.php?controller=product&action=add" method="POST" enctype="multipart/form-data">

            <label for="name">Nom du produit :</label>
            <input type="text" id="name" name="name" required>

            <label for="description">Description :</label>
            <textarea id="description" name="description" required></textarea>

            <label for="price">Prix :</label>
            <input type="number" id="price" name="price" step="1.00" required>

            <label for="category_id">Catégorie :</label>
            <select id="category_id" name="category_id" required>
                <option value="1">Lunettes de Soleil</option>
                <option value="2">Gilets</option>
                <option value="3">Écouteurs</option>
            </select>

            <label for="image">Image :</label>
            <input type="file" id="image" name="image" accept=".jpg,.jpeg,.png,.webp" required>

            <button type="submit">Ajouter le produit</button>
        </form>

    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>