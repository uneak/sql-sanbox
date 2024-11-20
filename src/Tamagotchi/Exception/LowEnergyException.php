<?php

    namespace App\Tamagotchi\Exception;

    use App\Tamagotchi\Tamagotchi;

    class LowEnergyException extends ActionException
    {
        private Tamagotchi $tamagotchi;

        public function __construct(Tamagotchi $tamagotchi)
        {
            $this->tamagotchi = $tamagotchi;
            parent::__construct('Not enough energy');
        }

        /**
         * @return int
         */
        public function getTamagotchi(): Tamagotchi
        {
            return $this->tamagotchi;
        }
    }