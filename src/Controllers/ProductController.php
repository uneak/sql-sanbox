<?php

namespace App\Controllers;
use App\Models\RoomManager;
use App\Models\UserManager;
use App\Services\Payment\PaymentMethodFactory;
use App\Models\PaymentMethodManager;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;


class ProductController 
{

    private Environment $twig;

    public function __construct(Environment $twig){
        $this->twig= $twig;
    }

    public function index() : string 
    {
        $userManager = new UserManager();
        $roomManager = new RoomManager();
        $paymentMethodManager = new PaymentMethodManager();

        if (!isset($_GET["product"])) {
            header("Location: /login");
            exit;
        }
        
        $user = $userManager->findById($_GET["user"]);
        $room = $roomManager->findById($_GET["product"]);

        $productPrice = $roomManager->getPriceByRole($room->getId(), $user->getUserRole());

        $paymentMethodFactory = new PaymentMethodFactory();
    
    
        if (isset($_POST["user"]) && isset($_POST["product"]) && isset($_POST["method"])) {
            $paymentMethod = $paymentMethodManager->findById($_POST["method"]);
            $payment = $paymentMethodFactory->getPaymentMethod($paymentMethod->getType());
    
            $postUser = $userManager->findById($_POST["user"]);;
            $price = $roomManager->getPriceByRole($_POST["product"], $postUser->getUserRole());
    
            $payment->pay($price, $paymentMethod->getData());
        }

    return $this->twig->render('product.html.twig' , [
    'user' => $user,
    'userMethodList' => $paymentMethodManager->findAll(10, 0, ['user' => $user->getId()]),
    'room' => $room,
    'price' => $productPrice,
]);      


}



}