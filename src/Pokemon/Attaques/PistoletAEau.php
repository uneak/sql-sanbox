<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type\EauType;

    class PistoletAEau extends Attaque implements AttaqueInterface
    {
        public function __construct()
        {
            parent::__construct("Pistolet à eau", 10, new EauType());
        }
    }