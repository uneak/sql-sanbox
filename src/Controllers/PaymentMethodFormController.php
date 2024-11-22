<?php

    namespace App\Controllers;

    use App\Models\PaymentMethodManager;
    use App\Models\UserManager;
    use App\Payment\PaymentFactory;

    class PaymentMethodFormController
    {
        private $twig;

        public function __construct($twig)
        {
            $this->twig = $twig;
        }

        public function creditCard() : string
        {
            if (!isset($_GET["user"])) {
                header("Location: /login");
                exit;
            }

            $userManager = new UserManager();
            $user = $userManager->findById($_GET["user"]);

            $isValidated = (isset($_POST["number"]) && isset($_POST["label"]) && isset($_POST["expiration"]) && isset($_POST["cvv"]));

            if ($isValidated) {
                $paymentMethodManager = new PaymentMethodManager();
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

            return $this->twig->render('payment_method/credit_card.html.twig', [
                'user' => $user,
                'isValidated' => $isValidated,
            ]);
        }

        public function bitcoin() : string
        {
            if (!isset($_GET["user"])) {
                header("Location: /login");
                exit;
            }

            $userManager = new UserManager();
            $user = $userManager->findById($_GET["user"]);

            $isValidated = (isset($_POST["address"]) && isset($_POST["label"]));

            if ($isValidated) {
                $paymentMethodManager = new PaymentMethodManager();
                $paymentMethodManager->create([
                    'label'   => $_POST["label"],
                    'type'    => 'bitcoin',
                    'user_id' => $user->getId(),
                    'data'    => [
                        'address'     => $_POST["address"],
                    ],
                ]);
            }

            return $this->twig->render('payment_method/bitcoin.html.twig', [
                'user' => $user,
                'isValidated' => $isValidated,
            ]);
        }


        public function bankTransfer() : string
        {
            if (!isset($_GET["user"])) {
                header("Location: /login");
                exit;
            }

            $userManager = new UserManager();
            $user = $userManager->findById($_GET["user"]);

            $isValidated = (isset($_POST["iban"]) && isset($_POST["bic"]) && isset($_POST["label"]));

            if ($isValidated) {
                $paymentMethodManager = new PaymentMethodManager();
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

            return $this->twig->render('payment_method/bank_transfer.html.twig', [
                'user' => $user,
                'isValidated' => $isValidated,
            ]);
        }


        public function paypal() : string
        {
            if (!isset($_GET["user"])) {
                header("Location: /login");
                exit;
            }

            $userManager = new UserManager();
            $user = $userManager->findById($_GET["user"]);

            $isValidated = (isset($_POST["email"]) && isset($_POST["password"]));

            if ($isValidated) {
                $paymentMethodManager = new PaymentMethodManager();
                $paymentMethodManager->create([
                    'label'   => $_POST["label"],
                    'type'    => 'paypal',
                    'user_id' => $user->getId(),
                    'data'    => [
                        'email'    => $_POST["email"],
                        'password' => $_POST["password"],
                    ],
                ]);
            }

            return $this->twig->render('payment_method/paypal.html.twig', [
                'user' => $user,
                'isValidated' => $isValidated,
            ]);
        }

    }