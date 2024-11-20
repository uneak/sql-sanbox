<?php
namespace App\design_pattern_paiement_bank;

use App\design_pattern_paiement_bank\PaymentSystem\Transaction\PaymentSystemFactory;
class PaymentManager{

    private static ?PaymentManager $instance = null; // L'attribut qui stockera l'instance unique
    public $nom = "PaymentManager";
    private $amountToPayment = 0;

    private PaymentSystemFactory $fabric;

    private mixed $transaction = null;

    private function __construct($amountToPayment){
        self::$instance = $this;
        $this->amountToPayment = $amountToPayment;
    }

     /**
     * Get the value of instance
     */ 
    public static function getInstance($amountToPayment)
    {
        if (self::$instance === null) {
            // echo"L'instance de PaymentManager n'existe pas, passe dans le new";
            self::$instance = new PaymentManager($amountToPayment);
        }
        return self::$instance;
    }

    /**
     * Get the value of amountToPayment
     */ 
    public function getAmountToPayment()
    {
        return $this->amountToPayment;
    }

    /**
     * Set the value of amountToPayment
     *
     * @return  self
     */ 
    public function setAmountToPayment($amountToPayment)
    {
        $this->amountToPayment = $amountToPayment;

        return $this;
    }

    /**
     * Get the value of fabric
     */ 
    public function getFabric()
    {
        return $this->fabric;
    }

    /**
     * Set the value of fabric
     *
     * @return  self
     */ 
    public function setFabric($fabric)
    {
        $this->fabric = $fabric;

        return $this;
    }

    /**
     * Get the value of transaction
     */ 
    public function getTransaction()
    {
        return $this->transaction;
    }

    /**
     * Set the value of transaction
     *
     * @return  self
     */ 
    public function setTransaction($transaction)
    {
        $this->transaction = $transaction;

        return $this;
    }


   
}