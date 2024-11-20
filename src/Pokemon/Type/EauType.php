<?php

    namespace App\Pokemon\Type;

    use App\Pokemon\Type;

    readonly class EauType extends Type
    {
        public function __construct() {
            parent::__construct("Eau");
        }
    }