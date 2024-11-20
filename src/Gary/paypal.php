<?php

    namespace App\Gary;

    class paypal extends TypePaiement
    {

        public string $processPayment;
        public string $email;

        public function __construct(string $email, string $processPayment)
        {
            $this->processPayment = $processPayment;
            $this->email = $email;
        }

        public function paiement(float $montant): void {
            $now = new \DateTime();

            echo sprintf(
                "Paiement de %s€ effectué avec le compte paypal %s le %s",
                $montant,
                $this->email,
                $now->format('Y-m-d H:i:s')
            );
        }
    }