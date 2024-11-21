<?php

    namespace App\Controllers;

    use App\Models\PaymentMethodManager;
    use App\Models\RoomManager;
    use App\Models\UserManager;
    use App\Payment\PaymentFactory;

    class ProductController
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

            if (!isset($_GET["product"])) {
                header("Location: ?user={$_GET["user"]}");
                exit;
            }

            $userManager = new UserManager();
            $user = $userManager->findById($_GET["user"]);

            $roomManager = new RoomManager();
            $room = $roomManager->findById($_GET["product"]);
            $roomPrice = $roomManager->getPriceByRole($room->getId(), $user->getUserRole());

            $paymentMethodManager = new PaymentMethodManager();
            $userPaymentMethodList = $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]);

            $paymentFactory = new PaymentFactory();

            $userMethodList = [];
            foreach ($userPaymentMethodList as $paymentMethod) {
                $userMethodList[] = [
                    'type' => $paymentFactory->getPaymentType($paymentMethod->getType())->getName(),
                    'paymentMethod' => $paymentMethod,
                ];
            }


            if (isset($_POST["user"]) && isset($_POST["product"]) && isset($_POST["method"])) {

                $postUser = $userManager->findById($_POST["user"]);;
                $price = $roomManager->getPriceByRole($_POST["product"], $postUser->getUserRole());

                $paymentMethod = $paymentMethodManager->findById($_POST["method"]);
                $paymentMethodManager->pay($paymentMethod, $price);
            }


            return $this->twig->render('product.html.twig', [
                'user' => $user,
                'room' => $room,
                'userMethodList' => $userMethodList,
                'price' => $roomPrice,
            ]);
        }

    }