<?php

    namespace App\Gary;


    class CarteBancaire extends TypePaiement
    {
        public string $processPayment;
        public int $numeroCarte;
        public int $ccv;

        public function __construct(int $numeroCarte, int $ccv, string $processPayment = "Carte bancaire")
        {
            $this->processPayment = $processPayment;
            $this->numeroCarte = $numeroCarte;
            $this->ccv = $ccv;
        }

        public function paiement(float $montant): void {
            echo sprintf(
                "Paiement de %s€ effectué avec la carte %s",
                $montant,
                $this->numeroCarte
            );
        }
    }