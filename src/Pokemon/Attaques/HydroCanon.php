<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type;
    use App\Pokemon\Type\EauType;
    use App\Pokemon\Type\FeuType;

    class HydroCanon extends Attaque implements AttaqueInterface
    {
        public function __construct()
        {
            parent::__construct("HydroCanon", 10, new EauType());
        }
    }