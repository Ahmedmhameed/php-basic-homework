<?php
spl_autoload_register(function ($className) {
    // Strip 'App\' prefix and replace backslashes with forward slashes
    $path = 'src/' . str_replace('App\\', '', $className);
    $path = str_replace('\\', '/', $path) . '.php';

    if (file_exists($path)) {
        require_once $path;
    }
});