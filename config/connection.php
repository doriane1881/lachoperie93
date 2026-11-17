<?php
// La configuration Wamp existante reste privée et inchangée.
if (getenv('APP_ENV') === 'production') {
    require_once __DIR__ . '/database.production.php';
} else {
    require_once __DIR__ . '/database.php';
}
