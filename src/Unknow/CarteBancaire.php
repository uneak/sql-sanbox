<?php

namespace App\Unknow;

use App\Unknow\interfaces\InterfacePaiement;

class CarteBancaire implements InterfacePaiement{

    private int $numberCompte;
    private string $mois;
    private string $annee;
    private int $numberCarte;

    public function __construct(int $numberCompte,string $mois,string $annee,int $numberCarte)
    {
        $this->numberCompte = $numberCompte;
        $this->mois = $mois;
        $this->annee = $annee;
        $this->numberCarte = $numberCarte;
    }


    public function processPayment(float $amount): string

    {
        echo "CB</br>";
        echo " Numéro de compte : " . $this->numberCompte . " .</br> ";
        echo " Mois/Année : " . $this->mois. $this->annee . " . </br> ";
        echo " Numéro de carte : " . $this->numberCarte . " .</br> ";
        return " Le paiement de " . $amount . " € à été effectuer par carte bancaire . </br> ";
    }

    public function getNumberCompte(): string
    {
        return $this->numberCompte;
    }

    public function getAnnee(): string
    {
        return $this->annee;
    }
    public function getMois(): string
    {
        return $this->mois;
    }
    public function getNumberCarte(): string
    {
        return $this->numberCarte;
    }


}