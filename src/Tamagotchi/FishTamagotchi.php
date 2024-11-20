<?php

    namespace App\Tamagotchi;

    use App\Tamagotchi\Action\ActionInterface;
    use App\Tamagotchi\Action\RestAction;
    use App\Tamagotchi\Action\SwimAction;

    class FishTamagotchi extends Tamagotchi
    {
        public function __construct(string $name, int $energy = 100, int $hunger = 0)
        {
            parent::__construct($name, [
                SwimAction::class,
            ], $energy, $hunger);
        }

        public function getDefaultAction(): ActionInterface
        {
            return new RestAction();
        }
    }