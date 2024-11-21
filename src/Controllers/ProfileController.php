<?php
<<<<<<< HEAD
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

        

        if (isset($_POST["user"]) && isset($_POST["method"])) {
            $controller = "";
            switch ($_POST["method"]) {
                case 'bank_transfer':

                    break;
                case 'paypal':

                    break;
                case 'bitcoin':
                    $controller = "form-bitcoin";
                    break; 
                case 'credit_card':
                    
                    break;
                default:
                    # code...
                    break;
            }

            // header("Location: form_".$_POST["method"].".php?user={$_POST["user"]}");
            header("Location: ".$controller."?user={$_POST["user"]}");
            exit;
        }

        return $this->twig->render('profile.html.twig', [
            'user' => $user,
            'userMethodList' => $userMethodList,
            'methodList' => $methodList

        ]);

    }

=======

    namespace App\Controllers;

    use App\Models\PaymentMethodManager;
    use App\Models\UserManager;
    use App\Services\Payment\PaymentMethodFactory;
    use Twig\Environment;
    use Twig\Loader\FilesystemLoader;

    class ProfileController{

        private Environment $twig;


        public function __construct(Environment $twig) {
             $this->twig = $twig;
            
        }
        public function profile() {

            $userManager = new UserManager();
            $paymentMethodManager = new PaymentMethodManager();
            $paymentMethodFactory = new PaymentMethodFactory();

            if (!isset($_GET["user"])) {
                header("Location: /login");
                exit;
            }
        
            $user = $userManager->findById($_GET["user"]);
            $userMethodList = $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]);
            $methodList = $paymentMethodFactory->getPaymentMethods();
        
        
            if (isset($_POST["user"]) && isset($_POST["method"])) {
                header("Location: form_".$_POST["method"].".php?user={$_POST["user"]}");
                exit;
            }
            return $this->twig->render('profile.html.twig', [
                'user' => $user,
                'userMethodList' => $userMethodList,
                'methodList' => $methodList
        
        ]);
    }
>>>>>>> modifs
}