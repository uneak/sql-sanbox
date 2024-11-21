<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Payment\Payment;
    use App\Payment\PaymentMethodFactory;
    use App\Payment\PaymentMethodManager;
    use App\Reservation\RoomManager;
    use App\Reservation\UserManager;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $userManager = new UserManager();
    $roomManager = new RoomManager();
    $paymentMethodManager = new PaymentMethodManager();
    $loader = new FilesystemLoader(dirname(__DIR__, 2) . '/templates');
    $twig = new Environment($loader);

    if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
    }

    if (!isset($_GET["product"])) {
        header("Location: home.php?user={$_GET["user"]}");
        exit;
    }

    $user = $userManager->findById($_GET["user"]);
    $room = $roomManager->findById($_GET["product"]);

	$productPrice = $roomManager->getPriceByRole($room->getId(), $user->getUserRole());

    $paymentMethodFactory = new PaymentMethodFactory();


    if (isset($_POST["user"]) && isset($_POST["product"]) && isset($_POST["method"])) {
        $paymentMethod = $paymentMethodManager->findById($_POST["method"]);
        $payment = $paymentMethodFactory->getPaymentMethod($paymentMethod->getType());

		$postUser = $userManager->findById($_POST["user"]);;
		$price = $roomManager->getPriceByRole($_POST["product"], $postUser->getUserRole());

        $payment->pay($price, $paymentMethod->getData());
    }

	echo $twig->render('product.html.twig' , [
        'user' => $user,
        'userMethodList' => $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]),
		'room' => $room,
		'price' => $productPrice
    ]);

