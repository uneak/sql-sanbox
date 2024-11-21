<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Models\PaymentMethodManager;
    use App\Models\UserManager;
    use App\Services\Payment\PaymentMethodFactory;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $loader = new FilesystemLoader(dirname(__DIR__, 2) . '/templates');
    $twig = new Environment($loader);

    $userManager = new UserManager();
    $paymentMethodFactory = new PaymentMethodFactory();
    $paymentMethodManager = new PaymentMethodManager();

    if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
    }

    $user = $userManager->findById($_GET["user"]);

	

    $isValidated = (isset($_POST["number"]) && isset($_POST["label"]) && isset($_POST["expiration"]) && isset($_POST["cvv"]));


    if ($isValidated) {
        $paymentMethodManager->create([
            'label'   => $_POST["label"],
            'type'    => 'credit_card',
            'user_id' => $user->getId(),
            'data'    => [
                'number'     => $_POST["number"],
                'expiration' => $_POST["expiration"],
                'cvv'        => $_POST["cvv"],
            ],
        ]);
    }

	echo $twig->render('form_credit_card.html.twig', [
		'user' => $user,
		"isValidated" => $isValidated
	]);

?>
