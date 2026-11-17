<?php
// Aucun secret dans ce fichier : les valeurs viennent du serveur d'hébergement.
try {
    $values = [];
    foreach (['DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD'] as $name) {
        $value = getenv($name);
        if ($value === false || $value === '') {
            throw new RuntimeException('Configuration MySQL incomplète.');
        }
        $values[$name] = $value;
    }
    $port = getenv('DB_PORT') ?: '3306';
    if (!ctype_digit($port) || (int)$port < 1 || (int)$port > 65535
        || preg_match('/[;\x00-\x1f]/', $values['DB_HOST'] . $values['DB_NAME'])) {
        throw new RuntimeException('Configuration MySQL invalide.');
    }
    $pdo = new PDO(
        'mysql:host=' . $values['DB_HOST'] . ';port=' . $port
            . ';dbname=' . $values['DB_NAME'] . ';charset=utf8mb4',
        $values['DB_USER'],
        $values['DB_PASSWORD'],
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_EMULATE_PREPARES => false]
    );
} catch (Throwable $e) {
    // Ne pas exposer les identifiants, le DSN ou le message PDO au navigateur.
    error_log('La Choperie 93 : connexion MySQL de production indisponible.');
    http_response_code(503);
    exit('Service temporairement indisponible.');
}
