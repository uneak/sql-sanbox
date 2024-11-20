<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type\PlanteType;

    class TempeteVerte extends Attaque implements AttaqueInterface
    {
        public function __construct()
        {
            parent::__construct("Tempete verte", 10, new PlanteType());
        }
    }