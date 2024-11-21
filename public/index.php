<?php

    require __DIR__ . '/../vendor/autoload.php';

    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use App\Controllers\PaymentMethodFormController;
    use App\Controllers\ProductController;
    use App\Controllers\ProfileController;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $loader = new FilesystemLoader(['../templates', '../src/Views']);
    $twig = new Environment($loader);

    $url = $_GET['url'] ?? '';

    $html = match ($url) {
        '' => (new HomeController($twig))->index(),
        'login' => (new LoginController($twig))->index(),
        'profile' => (new ProfileController($twig))->index(),
        'profile/credit-card/create' => (new PaymentMethodFormController($twig))->creditCard(),
        'profile/bitcoin/create' => (new PaymentMethodFormController($twig))->bitcoin(),
        'profile/bank-transfer/create' => (new PaymentMethodFormController($twig))->bankTransfer(),
        'profile/paypal/create' => (new PaymentMethodFormController($twig))->paypal(),
        'product' => (new ProductController($twig))->index(),
        default => $twig->render('404.html.twig'),
    };

    echo $html;
