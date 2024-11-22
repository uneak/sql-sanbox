<?php

    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use App\Controllers\PaymentMethodFormController;
    use App\Controllers\ProductController;
    use App\Controllers\ProfileController;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    require __DIR__ . '/../vendor/autoload.php';



    $loader = new FilesystemLoader('../src/Views');
    $twig = new Environment($loader);

    $parsedUrl = parse_url($_SERVER['REQUEST_URI']);

    $html = match ($parsedUrl['path']) {
        '/' => (new HomeController($twig))->index(),
        '/login' => (new LoginController($twig))->index(),
        '/profile' => (new ProfileController($twig))->index(),
        '/profile/credit-card/create' => (new PaymentMethodFormController($twig))->creditCard(),
        '/profile/bitcoin/create' => (new PaymentMethodFormController($twig))->bitcoin(),
        '/profile/bank-transfer/create' => (new PaymentMethodFormController($twig))->bankTransfer(),
        '/profile/paypal/create' => (new PaymentMethodFormController($twig))->paypal(),
        '/product' => (new ProductController($twig))->index(),
        default => $twig->render('404.html.twig'),
    };

    echo $html;
