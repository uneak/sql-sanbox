<?php

    namespace App\Exo;

    readonly class Contactable implements ContactableInterface, EmailableInterface
    {

        public function __construct(
            private string $nom,
            private string $prenom,
            private string $email,
        ) { }

        public function getNom(): string
        {
            return $this->nom;
        }

        public function getPrenom(): string
        {
            return $this->prenom;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getSender(): string
        {
            return $this->getNom() . ' ' . $this->getPrenom() . ' &lt;' . $this->getEmail() . '&gt;';
        }
    }