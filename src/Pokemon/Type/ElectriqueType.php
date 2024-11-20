<?php

    namespace App\Pokemon\Type;

    use App\Pokemon\Type;

    readonly class ElectriqueType extends Type
    {
        public function __construct() {
            parent::__construct("Electrique");
        }
    }