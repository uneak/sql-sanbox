<?php

    namespace App\Gary;

    class virementBancaire extends TypePaiement
    {
        public string $processPayment;
        public int $rib;

        public function __construct(int $rib, string $processPayment = "Virement bancaire")
        {
            $this->processPayment = $processPayment;
            $this->rib = $rib;
        }

        public function paiement(float $montant): void {
            echo sprintf(
                "Paiement de %s€ effectué avec le rib %s",
                $montant,
                $this->rib
            );
        }
    }