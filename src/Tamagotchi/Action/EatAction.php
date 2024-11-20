<?php

    namespace App\Tamagotchi\Action;

    use App\Tamagotchi\Tamagotchi;

    class EatAction implements ActionInterface
    {
        public function getName(): string
        {
            return "Eat";
        }

        public function getHungerIncrease(): int
        {
            return 10;
        }

        public function getEnergyCost(): int
        {
            return 10;
        }

        public function executeAction(Tamagotchi $tamagotchi): void
        {
            $tamagotchi->setHunger($tamagotchi->getHunger() + $this->getHungerIncrease());
            $tamagotchi->setEnergy($tamagotchi->getEnergy() - $this->getEnergyCost());
        }
    }