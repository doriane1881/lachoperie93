<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h2>Mon panier</h2>

    <?php if (empty($cart)): ?>
        <p>Votre panier est vide.</p>
    <?php else: ?>

        <table border="1" cellpadding="10">
            <tr>
                <th>Produit</th>
                <th>Prix</th>
                <th>Quantité</th>
                <th>Total</th>
                <th>Action</th>
            </tr>

            <?php $totalGeneral = 0; ?>

            <?php foreach ($cart as $item): ?>
                <?php
                    $total = $item['price'] * $item['quantity'];
                    $totalGeneral += $total;
                ?>
                <tr>
                    <td><?php echo htmlspecialchars($item['name']); ?></td>
                    <td><?php echo htmlspecialchars($item['price']); ?> €</td>
                    <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                    <td><?php echo number_format($total, 2, ',', ' '); ?> €</td>
                    <td>
                        <a href="index.php?controller=cart&action=remove&id=<?php echo $item['id']; ?>">
                            Retirer
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>

        </table>

        <h3>Total général : <?php echo number_format($totalGeneral, 2, ',', ' '); ?> €</h3>

    <?php endif; ?>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>