<?php
namespace App\design_pattern_paiement_bank\PaymentSystem\ENUM;


enum ModePayment: string
{
    case CB = 'CB';
    case PAYPAL = 'PAYPAL';
    case VIREMENT = 'VIREMENT';
}