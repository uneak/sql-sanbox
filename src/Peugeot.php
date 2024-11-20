<?php

    require 'Car.php';

    class Peugeot extends Car
    {
        public function __construct(?string $nom = null)
        {
            parent::__construct("Peugeot", $nom, 100);
        }
    }