<?php


    namespace App\Controllers;

    use App\Models\PaymentMethodManager;
    use App\Models\UserManager;
    use App\Services\Payment\PaymentFactory;

    class ProfileController
    {
        private $twig;

        public function __construct($twig)
        {
            $this->twig = $twig;
        }

        public function index(string $userId) : string
        {

            if (!isset($userId)) {
                header("Location: /login");
                exit;
            }

            if (isset($_POST["user"]) && isset($_POST["method"])) {
                $url = match ($_POST["method"]) {
                    'credit_card' => "/profile/credit-card/create",
                    'bitcoin' => "/profile/bitcoin/create",
                    'bank_transfer' => "/profile/bank-transfer/create",
                    'paypal' => "/profile/paypal/create",
                    default => '',
                };

                header("Location: {$url}?user={$_POST["user"]}");
                exit;
            }

            $userManager = new UserManager();
            $paymentMethodManager = new PaymentMethodManager();
            $paymentFactory = new PaymentFactory();

            $user = $userManager->findById($userId);
            $userPaymentMethodList = $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]);
            $paymentTypes = $paymentFactory->getPaymentTypes();

            $methodList = [];
            foreach ($paymentTypes as $paymentType) {
                $methodList[$paymentType->getId()] = $paymentType->getName();
            }

            $userMethodList = [];
            foreach ($userPaymentMethodList as $userMethod) {
                $userMethodList[] = [
                    'type' => $paymentFactory->getPaymentType($userMethod->getType())->getName(),
                    'name' => $userMethod->getLabel(),
                ];
            }

            return $this->twig->render('profile.html.twig', [
                'user' => $user,
                'methodList' => $methodList,
                'userMethodList' => $userMethodList,
            ]);
        }

    }
