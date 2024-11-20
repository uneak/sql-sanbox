<?php

    namespace App\Gary;

    interface TypePaiementInterface
    {
        public function paiement(float $montant): void;
    }
