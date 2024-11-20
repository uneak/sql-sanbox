<?php

    namespace App\Tamagotchi;

    use App\Tamagotchi\Action\ActionInterface;
    use App\Tamagotchi\Action\BarkAction;
    use App\Tamagotchi\Action\EatAction;
    use App\Tamagotchi\Action\PlayAction;
    use App\Tamagotchi\Action\RestAction;
    use App\Tamagotchi\Action\SleepAction;

    class DogTamagotchi extends Tamagotchi
    {
        public function __construct(string $name, int $energy = 100, int $hunger = 0)
        {
            parent::__construct($name, [
                BarkAction::class,
                PlayAction::class,
            ], $energy, $hunger);
        }

        public function getDefaultAction(): ActionInterface
        {
            return new RestAction();
        }
    }