<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type\FeuType;

    class Flammeche extends Attaque implements AttaqueInterface
    {
        public function __construct()
        {
            parent::__construct("Flammeche", 10, new FeuType());
        }
    }