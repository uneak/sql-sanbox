<?php
namespace App\design_pattern_paiement_bank\PaymentSystem;


// use App\design_pattern\Exception\InvalidTransactionException;
use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionInterface;

class Bank{
    /**
     * Montant du compte bancaire
     * @var float
     */
    private float $amountAccount;
    private bool $isSuccefull = false;

    public function __construct($amountAccount){
        $this->amountAccount = $amountAccount;
    }

    public function isSuccefull():bool{
        return $this->isSuccefull;
    }

    

    /**
     * Get montant du compte bancaire
     *
     * @return  float
     */ 
    public function getAmountAccount()
    {
        return $this->amountAccount;
    }

    /**
     * Set montant du compte bancaire
     *
     * @param  float  $amountAccount  Montant du compte bancaire
     *
     * @return  self
     */ 
    public function setAmountAccount(float $amountAccount)
    {
        $this->amountAccount = $amountAccount;

        return $this;
    }

    public function randomProcessPaiement(TransactionInterface $paiementType):bool{
        $randomNum = rand(0,1);
        echo "randomNum = ".$randomNum;
        if ($randomNum == 0){
            $this->isSuccefull = false;
            $this->refusTransaction($paiementType);
            return $this->isSuccefull;
        }

        $this->isSuccefull = true;
        $this->succefullTransaction($paiementType);
        return $this->isSuccefull ;
    }

    private function refusTransaction(TransactionInterface $paiementType):void{
        $paiementType->setHasValidated(false);
    }

    private function succefullTransaction(TransactionInterface $paiementType):void{
        $paiementType->setHasValidated(true);
        // throw new InvalidTransactionException();
        
    }
}