<?php

namespace App\Unknow\interfaces;


interface InterfacePaiement {

public function processPayment(float $amount) : string;
}