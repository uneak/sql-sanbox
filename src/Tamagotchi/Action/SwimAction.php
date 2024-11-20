<?php

    namespace App\Tamagotchi\Action;

    use App\Tamagotchi\Tamagotchi;

    class SwimAction implements ActionInterface
    {

        public function __construct(
            private readonly int $distance = 1,
        ) { }

        public function getName(): string
        {
            return "Swim";
        }

        public function getHungerIncrease(): int
        {
            return 10;
        }

        public function getEnergyCost(): int
        {
            return $this->distance * 10;
        }

        public function executeAction(Tamagotchi $tamagotchi): void
        {
            $tamagotchi->setHunger($tamagotchi->getHunger() + $this->getHungerIncrease());
            $tamagotchi->setEnergy($tamagotchi->getEnergy() - $this->getEnergyCost());
        }
    }