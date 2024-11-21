<?php

    use App\Controllers\HomeController;
    use App\Controllers\LoginController;

    require __DIR__ . '/../vendor/autoload.php';


    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    $content = match ($parsedUrl['path']) {
        '/' => (new HomeController())->index(),
        '/login' => (new LoginController())->index(),
        default => '404.php',
    };

    echo $content;

