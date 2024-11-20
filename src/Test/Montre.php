<?php

    namespace App\Test;

    class Montre implements DeletableInterface
    {
        public int $heure;
        public int $min;
        public static int $nbMontre = 0;

        public function __construct()
        {
            Montre::$nbMontre = Montre::$nbMontre + 1;
        }

        public static function getNbMontre(): int
        {
            return Montre::$nbMontre;
        }

        public function chrono(): void
        {
            echo "top Chrono";
        }

        public function delete(): void
        {
            $this->heure = 400;
        }

        public function isDeleted(): bool
        {
            return false;
        }

        public function restore(): void
        {
            echo "restore";
        }
    }