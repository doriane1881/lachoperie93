<?php require_once __DIR__ . '/../partials/header.php'; ?>

<main>
    <h2>Connexion</h2>

    <?php if (!empty($error)): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form action="index.php?controller=user&action=login" method="post">

        <label for="email">Email :</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>

        <button type="submit">Se connecter</button>

    </form>
</main>

<?php require_once __DIR__ . '/../partials/footer.php'; ?>