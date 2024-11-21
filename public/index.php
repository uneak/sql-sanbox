<?php

    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    use App\Controllers\FormBankTransfert;

    require __DIR__ . '/../vendor/autoload.php';

    $loader = new FilesystemLoader('../src/Views');
    $twig = new Environment($loader);

    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    $content = match ($parsedUrl['path']) {
        '/' => (new HomeController($twig))->index(),
        '/login' => (new LoginController($twig))->index(),
        '/bank' => (new FormBankTransfert($twig))->transfert(),
        default => '404.php',
    };

    echo $content;

