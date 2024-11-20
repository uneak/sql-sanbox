<?php
namespace App\design_pattern_paiement_bank\PaymentSystem\Transaction;

use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionInterface;
use App\design_pattern_paiement_bank\PaymentSystem\Bank;

class TransactionPaypal implements TransactionInterface{

    private $email;
    private $password;

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
        $this->amount = $amount;
    }
    public function processPaiement(Bank $bank):bool{
        echo "Je contact Paypal et règle le montant de ".$this->amount;
        return $bank->randomProcessPaiement($this);
    }

    /**
     * Get the value of email
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }
}

    
