<?php require_once __DIR__ . '/../partials/header.php'; ?>

    <main>
        <h2>Inscription</h2>
        <?php if (isset($error)): ?>
            <p style="color: red;"><?php echo $error; ?></p>
        <?php endif; ?>
        <form action="index.php?controller=user&action=register" method="post">

            Nom d'utilisateur : <input type="text" name="username"><br><br>
            Email : <input type="email" name="email"><br><br>
            Mot de passe : <input type="password" name="password"><br><br>
            Confirmation Mot de passe : <input type="password" name="confirm_password"><br><br>
            <select id="role" name="role">
                <option value="client">Client</option>
                <option value="vendeur">Vendeur</option>
            </select>
            <button type="submit">S'inscrire</button>
        </form>
    </main>
<?php require_once __DIR__ . '/../partials/footer.php'; ?>