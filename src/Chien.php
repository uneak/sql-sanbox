<?php

    class Chien
    {
        // Propriétés
        public string $nom;
        public string $race;
        public int $age;
        public string $couleur;

        public bool $isDead = false;

        public int $energy = 100;


        public function aboyer() : void
        {
            $hasEnergy = $this->hasEnergy(30);
            if (!$hasEnergy) {
                echo $this->nom . " : trop fatigué, No aboyer<br/>";
                return;
            }

            if ($this->isDead) {
                echo $this->nom . " : RIP<br/>";
                return;
            }

            $this->setEnergy(-30); // 0 isDead=true
            echo $this->nom . " : Wouaf Wouaf !<br/>";
        }

        public function hasEnergy(int $valeur) : bool
        {
            return $this->energy - $valeur > 0;
        }

        public function setEnergy(int $valeur) : void
        {
            $this->energy = $this->energy + $valeur;

            if ($this->energy <= 0) {
                $this->isDead = true;
                $this->energy = 0;
            }
        }

        public function manger(string $aliment) : void
        {
            if ($this->isDead) {
                echo $this->nom . " : RIP<br/>";
                return;
            }

            switch ($aliment) {
                case 'viande':
                    $this->setEnergy(50);
                    break;
                case 'croquettes':
                    $this->setEnergy(30);
                    break;
                case 'os':
                    $this->setEnergy(20);
                    break;
                default:
                    $this->setEnergy(10);
                    break;
            }

            echo $this->nom . " : Miam Miam !<br/>";
            echo $this->nom . " : Energy = " . $this->energy . "<br/>";
        }

        public function leverLaPatte() : void
        {
            if ($this->isDead) {
                echo $this->nom . " : RIP<br/>";
                return;
            }

            if ($this->energy > 50) {
                echo $this->nom . " : patte levée<br/>";
            } else {
                echo $this->nom . " : trop fatigué, No patte levée<br/>";
            }
        }


    }