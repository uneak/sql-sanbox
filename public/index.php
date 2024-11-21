<?php

use App\Controllers\ProfileController;
    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    require __DIR__ . '/../vendor/autoload.php';

    $loader = new FilesystemLoader('../src/Views');
    $twig = new Environment($loader);

    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    $content = match ($parsedUrl['path']) {
        '/' => (new HomeController($twig))->index(),
        '/login' => (new LoginController($twig))->index(),
        '/profile' => (new ProfileController($twig))->profile(),
        default => '404.php',
    };

    echo $content;

