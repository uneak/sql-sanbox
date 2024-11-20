<?php

    namespace App\Test;

    class Truc implements DeletableInterface
    {
        public int $sum;

        public int $premierChiffre;

        public function __construct($a, $bdejr, $c, $d, $e) {
            $this->premierChiffre = $a;
            $this->sum = $a + $bdejr + $c + $d + $e;
        }

        public function delete(): void
        {
            $this->premierChiffre = 500;
        }

        public function isDeleted(): bool
        {
            // TODO: Implement isDeleted() method.
        }

        public function restore(): void
        {
            // TODO: Implement restore() method.
        }
    }