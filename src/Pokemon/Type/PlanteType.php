<?php

    namespace App\Pokemon\Type;

    use App\Pokemon\Type;

    readonly class PlanteType extends Type
    {
        public function __construct() {
            parent::__construct("Plante");
        }
    }