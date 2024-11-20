<?php
    class Humain {
        // Propriétés typées
        protected string $nom;
        protected int $age;
        protected string $genre;
        protected float $taille;
        protected string $couleurPeau;
        protected string $origine;

        // Constructeur avec typage des paramètres
        public function __construct(string $nom, int $age, string $genre, string $origine) {
            $this->nom = $nom;
            $this->age = $age;
            $this->genre = $genre;
            $this->origine = $origine;
        }

        // Méthodes générales avec typage de retour
        public function parler(): void {
            echo "$this->nom dit : Hello ";
        }

        public function courir(): void {
            echo "$this->nom court !<br/>";
        }

        public function manger(): void {
            echo "$this->nom mange.<br/>";
        }

        public function dormir(): void {
            echo "$this->nom dort.<br/>";
        }

        public function caca(): void {
            echo "$this->nom fait caca.<br/>";
        }

        public function pipi(): void {
            echo "$this->nom fait pipi.<br/>";
        }
    }
