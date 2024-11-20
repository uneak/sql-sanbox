<?php

    namespace App\Tamagotchi\Action;

    use App\Tamagotchi\Tamagotchi;

    class RestAction implements ActionInterface
    {
        public function getName(): string
        {
            return "Rest";
        }

        public function getHungerIncrease(): int
        {
            return 0;
        }

        public function getEnergyCost(): int
        {
            return 10;
        }

        public function executeAction(Tamagotchi $tamagotchi): void
        {
            $tamagotchi->setEnergy($tamagotchi->getEnergy() + $this->getEnergyCost());
        }
    }