<?php

    namespace App\Tamagotchi\Action;

    use App\Tamagotchi\Tamagotchi;

    interface ActionInterface
    {
        public function getName(): string;
        public function executeAction(Tamagotchi $tamagotchi): void;
        public function getHungerIncrease(): int;
        public function getEnergyCost(): int;
    }