<?php
namespace App\Controllers;

use App\Models\PaymentMethodManager;
use App\Models\UserManager;
use App\Services\Payment\PaymentMethodFactory;
use Twig\Environment;

class ProfileController {

    private Environment $twig;

    public function __construct(Environment $twig) {
        $this->twig = $twig;
    }

    public function index() : string
    { 

        $userManager = new UserManager();
        $paymentMethodManager = new PaymentMethodManager();
        $paymentMethodFactory = new PaymentMethodFactory();

        if (!isset($_GET["user"])) {
            header("Location: index.php");
            exit;
        }

        $user = $userManager->findById($_GET["user"]);
        $userMethodList = $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]);
        $methodList = $paymentMethodFactory->getPaymentMethods();

        var_dump($_POST);

        if (isset($_POST["user"]) && isset($_POST["method"])) {
            echo "TEST<br>";
            // switch ($_POST["method"]) {
            //     case 'bitcoin':
            //         // echo "c"
            //         break;
                
            //     default:
            //         # code...
            //         break;
            // }

            header("Location: form_".$_POST["method"].".php?user={$_POST["user"]}");
            exit;
        }

        return $this->twig->render('profile.html.twig', [
            'user' => $user,
            'userMethodList' => $userMethodList,
            'methodList' => $methodList

        ]);

    }

}