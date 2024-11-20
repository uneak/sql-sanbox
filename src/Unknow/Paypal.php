<?php

namespace App\Unknow;
use App\Unknow\interfaces\InterfacePaiement;

class Paypal implements InterfacePaiement{

    private string $email;

    public function __construct(string $email)
    {
    $this->email = $email;
    }

    public function processPayment(float $amount): string
    {
        echo "Paypal</br>";
        echo " Email : " . $this->email . " . </br>";
        return " Le paiement de " . $amount . " € à été effectué par virement Paypal. </br> "; 
    }


    public function getEmail(): string
    {
        return $this->email;
    }
}