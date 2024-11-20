<?php

    namespace App\Exo;

    readonly class User implements ContactableInterface, CallableInterface, EmailableInterface
    {
        public function __construct(
            private string $nom,
            private string $prenom,
            private int $age,
            private string $email,
            private string $telephone,
        ) {
        }

        public function getNom(): string
        {
            return $this->nom;
        }

        public function getPrenom(): string
        {
            return $this->prenom;
        }

        public function getSender(): string
        {
            return $this->getNom() . ' ' . $this->getPrenom() . ' &lt;' . $this->getEmail() . '&gt;';
        }

        public function getAge(): int
        {
            return $this->age;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getTelephone(): string
        {
            return $this->telephone;
        }
    }