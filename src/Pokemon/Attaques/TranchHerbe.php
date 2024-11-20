<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type\PlanteType;

    class TranchHerbe extends Attaque implements AttaqueInterface
    {
        public function __construct()
        {
            parent::__construct("Tranch herbe", 10, new PlanteType());
        }
    }