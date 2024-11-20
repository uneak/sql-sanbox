<?php

    namespace App\Gary;

    class SystemPayment
    {
        public array $methodPayments;

        public function __construct(array $methodPayments)
        {
            $this->methodPayments = [];
            foreach ($methodPayments as $methodPayment) {
                $this->methodPayments[$methodPayment->processPayment] = $methodPayment;
            }
        }

        public function demanderPaiement(float $montant, string $type): void
        {
            $this->methodPayments[$type]->paiement($montant);
        }

    }