<?php
// Copier en database.php (ignore par Git), puis renseigner les valeurs locales.
$host = 'MYSQL_HOST';
$dbname = 'MYSQL_DATABASE';
$username = 'MYSQL_USER';
$password = 'MYSQL_PASSWORD';

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $username,
        $password,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Connexion à la base de données indisponible.');
}
