<?php

    class Animal
    {
        // Propriétés
        public string $nom;
        private string $prenom;
        public int $age;


        public function __construct(string $nom, string $prenom, int $age)
        {
            $this->nom = $nom;
            $this->prenom = $prenom;
            $this->age = $age;
        }


        // Méthode
        public function parler() : void
        {
            echo "L'animal fait un bruit.";
        }

        public function getPrenom() : string
        {
            return $this->prenom;
        }

        public function setPrenom(string $prenom) : void
        {
            $this->prenom = $prenom;
        }
    }






    // Création d'un objet de la classe Animal
    $monAnimal = new Animal("Felix", 'Le chat', 5);
    // Attribution de valeurs aux propriétés
    $monAnimal->nom = "Luna";
    $monAnimal->age = 3;


    $prenom = $monAnimal->getPrenom();


    $monAnimal->setPrenom('La lune');



    // Appel de la méthode
    $monAnimal->parler(); // Affiche "L'animal fait un bruit."
