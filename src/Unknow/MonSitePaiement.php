<?php

    namespace App\Unknow;

    class MonSitePaiement extends MethodePayment
    {
        public function __construct() {
            parent::__construct([
                "vir" => new VirementBancaire(2345577668668),
                "cb"  => new CarteBancaire(435192234, "Novembre", 2024, 499001013676376232),
                "pp"  => new Paypal("laro.drucila@gmail.com"),
            ]);
        }
    }