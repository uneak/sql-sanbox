<?php
namespace App\design_pattern_paiement_bank\PaymentSystem\Transaction;

use App\design_pattern_paiement_bank\PaymentSystem\Transaction\TransactionInterface;

abstract class PaymentSystemFactory{


    abstract public function paymentMethod() : TransactionInterface;

    public function transaction() : void{
        echo "function transaction";
    }

}