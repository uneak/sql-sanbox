<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type;

    interface AttaqueInterface
    {
        public function getNom(): string;
        public function getDegats(): int;
        public function getType(): Type;
    }