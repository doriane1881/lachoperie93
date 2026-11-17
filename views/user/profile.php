<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h2>Profil</h2>

    <p><strong>Nom d'utilisateur :</strong> <?php echo htmlspecialchars($user['username']); ?></p>
    <p><strong>Email :</strong> <?php echo htmlspecialchars($user['email']); ?></p>
    <p><strong>Rôle :</strong> <?php echo htmlspecialchars($user['role']); ?></p>

</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>