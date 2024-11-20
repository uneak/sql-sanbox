<?php

    class Caro
    {
        public string $nom;
        public string $marque;
        public float $position = 0;
        public float $vitesse = 10;

        public function avancer(float $step = 1) : void
        {
            $this->position += $this->vitesse * $step;
            echo sprintf(" * La voiture %s <strong>avance</strong> de %.2f pas a une vitesse de %.2f, et se retrouve à %.2f Km <br/>", $this->nom, $step, $this->vitesse, $this->position);
        }

        public function reculer(float $step = 1) : void
        {
            $this->position -= $this->vitesse * $step;
            echo sprintf(" * La voiture %s <strong>recule</strong> de %.2f pas a une vitesse de %.2f, et se retrouve à %.2f Km <br/>", $this->nom, $step, $this->vitesse, $this->position);
        }

    }