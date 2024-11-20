<?php
namespace App\design_pattern_paiement_bank\PaymentSystem\Transaction;
use App\design_pattern_paiement_bank\PaymentSystem\Bank;

interface TransactionInterface {

    public function hasValidated():bool;
    public function setHasValidated($bool);
    
    public function getAmount():float;

    public function setAmount($amount):void;

    public function processPaiement(Bank $bank):bool;
}