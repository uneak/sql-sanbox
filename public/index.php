<?php


    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use App\Controllers\FormBitcoinController;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;
    use App\Controllers\ProfileController;

    require __DIR__ . '/../vendor/autoload.php';


    $loader = new FilesystemLoader('../src/Views');
    $twig = new Environment($loader);

    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    $content = match ($parsedUrl['path']) {
        '/' => (new HomeController($twig))->index(),
        '/login' => (new LoginController($twig))->index(),
        '/profile' => (new ProfileController($twig))->index(),
        '/form-bitcoin' => (new FormBitcoinController($twig))->index(),
        default => '404.php',
    };

    echo $content;

