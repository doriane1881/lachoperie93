<?php
require_once __DIR__ . '/../config/connection.php';
require_once __DIR__ . '/../models/User.php';
class UserController
{
    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: index.php');
        exit;
    }
    public function register()
{
    global $pdo;
    $error = '';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = trim($_POST['username'] ?? '');
        $email = trim($_POST['email'] ?? '');
        $password = $_POST['password'] ?? '';
        $confirmPassword = $_POST['confirm_password'] ?? '';
        $role = $_POST['role'] ?? 'client';

        if (!in_array($role, ['client', 'vendeur'])) {
            $role = 'client';
        }

        if ($username === '' || $email === '' || $password === '' || $confirmPassword === '') {
            $error = 'Tous les champs sont obligatoires.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = "L'adresse email n'est pas valide.";
        } elseif (strlen($password) < 10) {
            $error = "Le mot de passe doit contenir au moins 10 caractères.";
        } elseif ($password !== $confirmPassword) {
            $error = "Les mots de passe ne correspondent pas.";
        }

        if ($error !== '') {
            require_once __DIR__ . '/../views/user/register.php';
            exit();
        }

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        try {
            createUser($pdo, $username, $email, $passwordHash, $role);
            header('Location: index.php?controller=user&action=login');
            exit();
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) {
                $error = "Un compte avec ce nom d'utilisateur ou cette adresse email existe déjà.";
            } else {
                $error = "Une erreur est survenue lors de l'inscription.";
            }

            require_once __DIR__ . '/../views/user/register.php';
            exit();
        }
    }

    require_once __DIR__ . '/../views/user/register.php';
}
public function login()
    {
        global $pdo;
        $error = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = trim($_POST['email'] ?? '');
            $password = $_POST['password'] ?? '';

            if ($email === '' || $password === '') {
                $error = 'Tous les champs sont obligatoires.';
                require_once __DIR__ . '/../views/user/login.php';
                exit();
            }

            $user = loginUser($pdo, $email, $password);

            if ($user) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header('Location: index.php');
                exit();
            } else {
                $error = 'Email ou mot de passe incorrect.';
                require_once __DIR__ . '/../views/user/login.php';
                exit();
            }
        }

        require_once __DIR__ . '/../views/user/login.php';
    }

    public function profile()
    {
        global $pdo;

        if (!isset($_SESSION['user_id'])) {
            header('Location: index.php?controller=user&action=login');
            exit();
        }

        $userId = $_SESSION['user_id'];
        $user = getUserById($pdo, $userId);

        require_once __DIR__ . '/../views/user/profile.php';
    }
}
?>


