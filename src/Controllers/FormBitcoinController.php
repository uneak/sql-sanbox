<?php
namespace App\Controllers;

use App\Models\PaymentMethodManager;
use App\Models\UserManager;
use App\Services\Payment\PaymentMethodFactory;
use Twig\Environment;

class FormBitcoinController {

    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index() : string
    { 

    $userManager = new UserManager();
    $paymentMethodFactory = new PaymentMethodFactory();
    $paymentMethodManager = new PaymentMethodManager();

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

    return $this->twig->render('form_bitcoin.html.twig', [
		'user'=>$user,
        'isValidated' => $isValidated,
    ]);

    }

}
