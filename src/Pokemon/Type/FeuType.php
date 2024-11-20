<?php

    namespace App\Pokemon\Type;

    use App\Pokemon\Type;

    readonly class FeuType extends Type
    {
        public function __construct() {
            parent::__construct("Feu");
        }
    }