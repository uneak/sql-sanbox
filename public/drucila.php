<?php

    require __DIR__ . '/../vendor/autoload.php';

    use App\Unknow\MonSitePaiement;
    use App\Unknow\TonSitePaiement;

    $new = new MonSitePaiement();
    $ton = new TonSitePaiement();


    $new->choixPayment(100, 'pp');
    echo " ---------------------------------------------------------------------- </br> ";
    $new->choixPayment(100, 'cb');
    echo " ---------------------------------------------------------------------- </br> ";
    $new->choixPayment(100, 'vir');


    try {
        echo " ---------------------------------------------------------------------- </br> ";
        $ton->choixPayment(100, 'vir');
    } catch (Exception $e) {
        echo "Erreur : " . $e->getMessage() . "</br>";
    }

