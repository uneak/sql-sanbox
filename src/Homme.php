<?php
    require_once 'Humain.php';
    class Homme extends Humain {

        public function __construct(string $nom, int $age, string $origine) {
            parent::__construct($nom, $age, "homme", $origine);
        }

        public function seRase(): void {
            echo "$this->nom se rase la barbe.<br/>";
        }

        public function parler(): void {
            echo "je suis un homme.<br/>";
        }

        public function caca(): void {
            echo "$this->nom fait caca fort ! car je suis un vrai mâle<br/>";
        }

    }
