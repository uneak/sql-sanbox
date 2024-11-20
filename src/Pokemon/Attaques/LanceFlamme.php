<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type\FeuType;

    class LanceFlamme extends Attaque implements AttaqueInterface
    {
        public function __construct()
        {
            parent::__construct("Lance-flamme", 10, new FeuType());
        }
    }