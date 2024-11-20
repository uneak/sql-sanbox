<?php

    namespace App\Tamagotchi\Action;

    use App\Tamagotchi\Tamagotchi;

    class BarkAction implements ActionInterface
    {
        public function getName(): string
        {
            return "Bark";
        }

        public function getHungerIncrease(): int
        {
            return 10;
        }

        public function getEnergyCost(): int
        {
            return 99;
        }

        public function executeAction(Tamagotchi $tamagotchi): void
        {
            $tamagotchi->setHunger($tamagotchi->getHunger() + $this->getHungerIncrease());
            $tamagotchi->setEnergy($tamagotchi->getEnergy() - $this->getEnergyCost());
        }
    }