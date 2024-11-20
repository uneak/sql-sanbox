<?php

    require_once __DIR__ . "/../vendor/autoload.php";

    use App\Gary\paypal;
    use App\Gary\CarteBancaire;
    use App\Gary\virementBancaire;
    use App\Gary\SystemPayment;

    $paypal = new paypal("gary@gmail.com", "Paypal");
//    $paypal->paiement(200);
    $cb = new CarteBancaire(123, "333","Carte bancaire");
//    $cb->paiement(200);
    $vir = new virementBancaire(123, "Virement bancaire");
//    $vir->paiement(200);


    $sp = new SystemPayment([$paypal, $cb, $vir]);
    $sp->demanderPaiement(200, "Paypal");
