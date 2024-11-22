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


	$loader = new FilesystemLoader(dirname(__DIR__, 2) .'/templates');
	$twig = new Environment($loader);



    if (!isset($_GET["user"])) {
        header("Location: index.php");
        exit;
    }

    
    $user = $userManager->findById($_GET["user"]);

    $currentUser = $_GET["user"];
	// $user = $userManager->findById($currentUser);

	

    $isValidated = (isset($_POST["address"]) && isset($_POST["label"]));

    if ($isValidated) {
        $paymentMethodManager->create([
            'label'   => $_POST["label"],
            'type'    => 'bitcoin',
            'user_id' => $user->getId(),
            'data'    => [
                'address'     => $_POST["address"],
            ],
        ]);
    }

echo $twig->render('form_bitcoin.html.twig', [
		'user'=>$user,
        'isValidated' => $isValidated,
    ]);

?>