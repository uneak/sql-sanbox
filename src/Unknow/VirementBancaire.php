<?php

namespace App\Unknow;

use App\Unknow\interfaces\InterfacePaiement;

class VirementBancaire implements InterfacePaiement{

    private int $rib;

    public function __construct(int $rib) {
        $this->rib = $rib;
    }

    public function processPayment(float $amount): string

    {
        echo "VirementBancaire</br>";
        echo " Numéro IBAN : " . $this->rib . " . </br> ";
        return "Paiement de " . $amount . " € éffectué par virement bancaire . </br> ";
    }


    public function getRib(): string 
    {
        return $this->rib;
    }

}