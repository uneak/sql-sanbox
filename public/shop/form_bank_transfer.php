<?php
    require __DIR__ . '/../../vendor/autoload.php';

    use App\Models\PaymentMethodManager;
    use App\Models\UserManager;
    use App\Services\Payment\PaymentMethodFactory;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    $userManager = new UserManager();
    $paymentMethodFactory = new PaymentMethodFactory();
    $paymentMethodManager = new PaymentMethodManager();

    if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
    }

    $user = $userManager->findById($_GET["user"]);

    $isValidated = (isset($_POST["iban"]) && isset($_POST["bic"]) && isset($_POST["label"]));

    if ($isValidated) {
        $paymentMethodManager->create([
            'label'   => $_POST["label"],
            'type'    => 'bank_transfer',
            'user_id' => $user->getId(),
            'data'    => [
                'iban'     => $_POST["iban"],
                'bic'     => $_POST["bic"],
            ],
        ]);


    }


	

    $loader = new FilesystemLoader(dirname(__DIR__, 2) . '/templates');
    $twig = new Environment($loader);

	if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
	}


    echo $twig->render('form_bank_transfer.html.twig', ['user' => $user,
	'isValidated'=> $isValidated,
]);
?>

?>