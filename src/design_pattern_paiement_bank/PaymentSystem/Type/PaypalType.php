<?php
namespace App\design_pattern_paiement_bank\PaymentSystem\Type;

use App\design_pattern_paiement_bank\PaymentSystem\ENUM\ModePayment;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionPaypal;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\PaymentSystemFactory;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionInterface;




   class PaypalType extends PaymentSystemFactory {

    protected $amount = 0;

    public function __construct($amount) {
        $this->amount = $amount; 
    }

    //*Création d'un Objet Transaction PayPal
    public function paymentMethod(): TransactionInterface{
    
        return new TransactionPaypal($this->amount);
    }

    public function getName(): ModePayment{
        return ModePayment::CB;
    }

}