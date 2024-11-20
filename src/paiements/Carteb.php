<?php


    namespace App\paiements;

    class Carteb implements ModePaiement
    {
        public mixed $dateExpiration;
        public float $numero;


        public function __construct($dateExpiration, $numero,)
        {
            $this->dateExpiration = $dateExpiration;
            $this->numero = $numero;
        }

        /**
         * Get the value of date
         */
        public function getDate()
        {
            return $this->dateExpiration;
        }

        /**
         * Get the value of number
         */
        public function getNumero()
        {
            return $this->numero;
        }


        public function payer($montant)
        {
            echo "Paiement d'un montant de $montant EUR effectué par Carte Bleue n° $this->numero.";
        }


    }

  