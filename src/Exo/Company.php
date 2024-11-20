<?php

    namespace App\Exo;

    readonly class Company implements CallableInterface, EmailInterface
    {

        public function __construct(
            private string $nom,
            private string $telephone,
            private string $email,
        ) {
        }

        public function getNom(): string
        {
            return $this->nom;
        }

        public function getTelephone(): string
        {
            return $this->telephone;
        }

        public function getEmail(): string
        {
            return $this->email;
        }
    }