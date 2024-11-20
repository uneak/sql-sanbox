<?php

    namespace App\paiements;


    class Central
    {
        /**
         * @var array<ModePaiement>
         */
        public array $paiements;

        public function __construct(array $paiements = [])
        {
            $this->paiements = $paiements;
        }

        public function effectuerPaiement($type, $montant)
        {
            $this->paiements[$type]->payer($montant);
            echo "l'achat a été effectué par $type, il est d'un montant de $montant EUR";
        }


    }