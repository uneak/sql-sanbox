<?php

    namespace App\Tamagotchi;

    use App\Tamagotchi\Action\ActionInterface;
    use App\Tamagotchi\Action\EatAction;
    use App\Tamagotchi\Action\RestAction;
    use App\Tamagotchi\Action\SleepAction;
    use App\Tamagotchi\Exception\InvalidActionException;
    use App\Tamagotchi\Exception\NotEnoughEnergyException;

    abstract class Tamagotchi
    {
        protected string $name;
        protected int $energy;
        protected int $maxEnergy;
        protected int $hunger;

        /**
         * @var array<class-string<ActionInterface>>
         */
        protected array $allowedActions = [];

        public function __construct(string $name, array $allowedActions = [], int $maxEnergy = 100, int $hunger = 0)
        {
            $defaultActions = [
                new RestAction(),
                new EatAction(),
                new SleepAction(),
            ];

            $this->name = $name;
            $this->maxEnergy = $maxEnergy;
            $this->energy = $maxEnergy;
            $this->hunger = $hunger;
            $this->allowedActions = array_merge($defaultActions, $allowedActions);
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getEnergy(): int
        {
            return $this->energy;
        }

        public function setEnergy(int $energy): void
        {
            if ($energy > $this->maxEnergy) {
                $energy = $this->maxEnergy;
            }

            if ($energy < 0) {
                $energy = 0;
            }

            $this->energy = $energy;
        }

        public function getHunger(): int
        {
            return $this->hunger;
        }

        public function setHunger(int $hunger): void
        {
            if ($hunger < 0) {
                $hunger = 0;
            }

            $this->hunger = $hunger;
        }

        public function getAllowedActions(): array
        {
            return $this->allowedActions;
        }



        abstract public function getDefaultAction(): ActionInterface;

        public function isTired(): bool
        {
            return ($this->getEnergy() < 20 || $this->getHunger() >= 50);
        }


        /**
         * @throws \Exception
         */
        public function performAction(ActionInterface $action): void
        {
            foreach ($this->getAllowedActions() as $actionClassName) {
                if ($action instanceof $actionClassName) {

                    if ($action->getEnergyCost() > $this->getEnergy()) {
                        throw new NotEnoughEnergyException("Not enough energy");
                    }

                    $action->executeAction($this);

                    echo sprintf(
                        "%s process %s : %s energy, %s hunger<br/>",
                        $this->getName(),
                        $action->getName(),
                        $this->getEnergy(),
                        $this->getHunger()
                    );

                    return;
                }
            }

            throw new InvalidActionException("Action not allowed");
        }

    }