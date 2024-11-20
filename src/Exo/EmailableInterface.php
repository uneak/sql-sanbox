<?php

    namespace App\Exo;

    interface EmailableInterface extends EmailInterface
    {
        public function getSender(): string; // "Marc Galoyer <mgaloyer@uneak.fr>"
    }