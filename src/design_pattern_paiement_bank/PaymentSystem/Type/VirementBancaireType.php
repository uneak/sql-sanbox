<?php
namespace App\design_pattern_paiement_bank\PaymentSystem\Type;

use App\design_pattern_paiement_bank\PaymentSystem\ENUM\ModePayment;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\PaymentSystemFactory;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionInterface;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionVirementBancaire;

class VirementBancaireType extends PaymentSystemFactory {
    protected $amount = 0;

    public function __construct($amount) {
        $this->amount = $amount; 
    }

    //*Création d'un Objet Transaction Virement
    public function paymentMethod(): TransactionInterface{
    
        return new TransactionVirementBancaire($this->amount);
    }

    public function getName(): string{
        return "Virement Bancaire";
    }


}