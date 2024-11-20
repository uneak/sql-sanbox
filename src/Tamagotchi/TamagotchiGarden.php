<?php

    namespace App\Tamagotchi;

    use App\Tamagotchi\Action\ActionInterface;
    use App\Tamagotchi\Exception\InvalidActionException;
    use App\Tamagotchi\Exception\LowEnergyException;
    use App\Tamagotchi\Exception\NotEnoughEnergyException;

    class TamagotchiGarden
    {
        /**
         * @var array<Tamagotchi>
         */
        private array $tamagotchis = [];

        public function __construct(array $tamagotchis = [])
        {
            $this->tamagotchis = $tamagotchis;
        }


        /**
         * @param array<\App\Tamagotchi\Action\ActionInterface> $actions
         *
         * @return void
         * @throws \Exception
         */
        public function performActions(array $actions): void
        {
            if ($this->isTired()) {
                return;
            }

            foreach ($this->tamagotchis as $tamagotchi) {
                if (!$tamagotchi->isTired()) {
                    foreach ($actions as $action) {

                        try {
                            $this->performAction($tamagotchi, $action);

                        } catch (LowEnergyException $e) {
                            $errorTamagotchi = $e->getTamagotchi();

                            echo $errorTamagotchi->getName() . " is too tired to perform any action, because his energy is too low : energy ".$errorTamagotchi->getEnergy() . " / hunger : " . $errorTamagotchi->getHunger() . "</br>";
                            break;
                        }
                    }
                }
            }
        }

        /**
         * @throws \Exception
         */
        public function performAction(Tamagotchi $tamagotchi, ActionInterface $action): void
        {
            try {
                $tamagotchi->performAction($action);
            } catch (InvalidActionException $e) {

                $defaultAction = $tamagotchi->getDefaultAction();
                echo $tamagotchi->getName() . " Invalid action ".$action->getName().", alternative action: " . $defaultAction->getName() . "</br>";
                $this->performAction($tamagotchi, $defaultAction);

            } catch (NotEnoughEnergyException $e) {

            }

            if ($tamagotchi->isTired()) {
                throw new LowEnergyException($tamagotchi);
            }
        }

        public function isTired(): bool
        {
            $tired = true;
            foreach ($this->tamagotchis as $tamagotchi) {
                $tired = $tired && $tamagotchi->isTired();
            }

            return $tired;
        }
    }