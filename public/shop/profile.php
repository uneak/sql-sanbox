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
        header("Location: form_".$_POST["method"].".php?user={$_POST["user"]}");
        exit;
    }

	echo $twig->render('profile.html.twig', [
        'user' => $user,
        'userMethodList' => $userMethodList,
        'methodList' => $methodList

]);
?>