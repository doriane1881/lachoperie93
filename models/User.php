<?php



function createUser($pdo, $username, $email, $passwordHash, $role)
{
    $sql = "INSERT INTO users (username, email, password, role) VALUES (?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$username, $email, $passwordHash, $role]);
}

function loginUser($pdo, $email, $password)
{
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);

    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        return $user;
    }

    return false;
}
function getUserById($pdo, $id)
{
    $sql = "SELECT id, username, email, role FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$id]);

    return $stmt->fetch(PDO::FETCH_ASSOC);
}
?>