<?php

    namespace App\paiements;

    class Virement implements ModePaiement
    {
        public string $iban;
        public float $numero;

        public function __construct($iban, $numero)
        {
            $this->iban = $iban;
            $this->numero = $numero;
        }

        /**
         * Get the value of iban
         */
        public function getIban()
        {
            return $this->iban;
        }

        /**
         * Get the value of numero
         */
        public function getNumero()
        {
            return $this->numero;
        }

        public function payer($montant)
        {
            echo "Paiement d'un montant de  $montant EUR effectué par Virement : IBAN numero $this->iban compte n° $this->numero.";
        }
    }