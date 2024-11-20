<?php
    require_once 'Humain.php';
    class Femme extends Humain {

        public function __construct(string $nom, int $age, string $origine) {
            parent::__construct($nom, $age, "femme", $origine);
        }

        public function seMaquille(): void {
            echo "$this->nom se maquille.<br/>";
        }

        public function parler(): void {
            parent::parler();
            echo "je suis un femme.<br/>";
        }

        public function caca(): void {
            echo "$this->nom ne fait pas caca car c'est une femme<br/>";
        }

        public function pipi(): void {
            echo "$this->nom fait pipi de temps en temps, mais rarement car c'est une femme<br/>";
        }
    }
