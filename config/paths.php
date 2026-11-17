<?php

// Les chemins en base restent relatifs au projet (ex. uploads/photo.jpg).
function assetUrl($path)
{
    $script = str_replace('\\', '/', $_SERVER['SCRIPT_NAME'] ?? '/index.php');
    $base = rtrim(str_replace('\\', '/', dirname($script)), '/.');
    $path = ltrim(str_replace('\\', '/', $path), '/');

    return $base . '/' . implode('/', array_map('rawurlencode', explode('/', $path)));
}
