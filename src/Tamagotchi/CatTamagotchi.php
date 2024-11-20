<?php

    namespace App\Tamagotchi;

    use App\Tamagotchi\Action\ActionInterface;
    use App\Tamagotchi\Action\EatAction;
    use App\Tamagotchi\Action\MeowAction;
    use App\Tamagotchi\Action\PlayAction;
    use App\Tamagotchi\Action\RestAction;
    use App\Tamagotchi\Action\SleepAction;

    class CatTamagotchi extends Tamagotchi
    {
        public function __construct(string $name, int $energy = 100, int $hunger = 0)
        {
            parent::__construct($name, [
                MeowAction::class,
                PlayAction::class,
            ], $energy, $hunger);
        }

        public function getDefaultAction(): ActionInterface
        {
            return new RestAction();
        }
    }