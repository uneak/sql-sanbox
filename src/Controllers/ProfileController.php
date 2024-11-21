<?php

    namespace App\Controllers;

    use App\Models\PaymentMethodManager;
    use App\Models\UserManager;
    use App\Payment\PaymentFactory;

    class ProfileController
    {
        private $twig;

        public function __construct($twig)
        {
            $this->twig = $twig;
        }

        public function index() : string
        {
            if (!isset($_GET["user"])) {
                header("Location: ?url=login");
                exit;
            }

            if (isset($_POST["user"]) && isset($_POST["method"])) {
                $url = match ($_POST["method"]) {
                    'credit_card' => "?url=profile/credit-card/create",
                    'bitcoin' => "?url=profile/bitcoin/create",
                    'bank_transfer' => "?url=profile/bank-transfer/create",
                    'paypal' => "?url=profile/paypal/create",
                    default => '',
                };

                header("Location: {$url}&user={$_POST["user"]}");
                exit;
            }

            $userManager = new UserManager();
            $paymentMethodManager = new PaymentMethodManager();
            $paymentFactory = new PaymentFactory();

            $user = $userManager->findById($_GET["user"]);
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