<?php
namespace App\design_pattern_paiement_bank\PaymentSystem\Transaction;

use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionInterface;
use App\design_pattern_paiement_bank\PaymentSystem\Bank;

class TransactionVirementBancaire implements TransactionInterface {


    private string $IBAN;
    private float $amount;
    private bool $hasValidated = false;

    public function __construct($amount){
        $this->amount = $amount;
    }

    public function hasValidated():bool{
        return $this->hasValidated;
    }
    /**
     * Set the value of hasValidated
     *
     * 
     */ 
    public function setHasValidated($hasValidated):void
    {
        $this->hasValidated = $hasValidated;

    }

    public function getAmount():float {
        return $this->amount;
    }

    public function setAmount($amount):void{
    
    }
    public function processPaiement(Bank $bank):bool{
        echo "Je contact la bank et règle par virement le montant de ".$this->amount;
        return $bank->randomProcessPaiement($this);
    }


    /**
     * Get the value of IBAN
     */ 
    public function getIBAN():string
    {
        return $this->IBAN;
    }

    /**
     * Set the value of IBAN
     *
     * @return  self
     */ 
    public function setIBAN($IBAN):void
    {
        $this->IBAN = $IBAN;
    }
}