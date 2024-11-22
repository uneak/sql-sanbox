<?php

    use App\Controllers\HomeController;
    use App\Controllers\LoginController;
    use App\Controllers\PaymentMethodFormController;
    use App\Controllers\ProductController;
    use App\Controllers\ProfileController;
    use Symfony\Component\HttpFoundation\Request;
    use Symfony\Component\Routing\Exception\ResourceNotFoundException;
    use Symfony\Component\Routing\Matcher\UrlMatcher;
    use Symfony\Component\Routing\RequestContext;
    use Symfony\Component\Routing\Route;
    use Symfony\Component\Routing\RouteCollection;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    require __DIR__ . '/../vendor/autoload.php';

    $loader = new FilesystemLoader('../src/Views');
    $twig = new Environment($loader);


    $routes = new RouteCollection();

    $routes->add('home', new Route('/', ['_controller' => [HomeController::class, 'index']]));
    $routes->add('login', new Route('/login', ['_controller' => [LoginController::class, 'index']]));


    $routes->add('profile', new Route('/profile/{userId}', ['_controller' => [ProfileController::class, 'index']]));


    $routes->add('profile_credit_card', new Route('/profile/credit-card/create',
        ['_controller' => [PaymentMethodFormController::class, 'creditCard']]));
    $routes->add('profile_bitcoin',
        new Route('/profile/bitcoin/create', ['_controller' => [PaymentMethodFormController::class, 'bitcoin']]));
    $routes->add('profile_bank_transfer', new Route('/profile/bank-transfer/create',
        ['_controller' => [PaymentMethodFormController::class, 'bankTransfer']]));
    $routes->add('profile_paypal',
        new Route('/profile/paypal/create', ['_controller' => [PaymentMethodFormController::class, 'paypal']]));
    $routes->add('product', new Route('/product', ['_controller' => [ProductController::class, 'index']]));

    $request = Request::createFromGlobals();
    $context = new RequestContext();
    $context->fromRequest($request);

    $matcher = new UrlMatcher($routes, $context);

    try {
        $parameters = $matcher->match($request->getPathInfo());

        //        [$controllerClass, $method] = $parameters['_controller'];
        $controllerClass = $parameters['_controller'][0];
        $method = $parameters['_controller'][1];

        unset($parameters['_controller']);
        unset($parameters['_route']);

        $controller = new $controllerClass($twig);
        $html = $controller->$method(...$parameters);

        echo $html;

    } catch (ResourceNotFoundException $e) {
        echo $twig->render('404.html.twig', ['exception' => $e]);
    } catch (Exception $e) {
        echo $twig->render('500.html.twig', ['exception' => $e]);
    }
