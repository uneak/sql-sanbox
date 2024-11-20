<?php

    namespace App\paiements;

    class Paypal implements ModePaiement
    {

        public string $email;
        public float $numero;


        public function __construct($email, $numero)
        {
            $this->email = $email;
            $this->numero = $numero;

        }

        /**
         * Get the value of nom
         */
        public function getEmail()
        {
            return $this->email;
        }

        /**
         * Get the value of montant
         */
        public function getNumero()
        {
            return $this->numero;
        }

        public function payer($montant)
        {
            echo "Paiement d'un montant de $montant EUR effectué par PayPal, compte n° $this->numero, email : $this->email.";
        }


    }