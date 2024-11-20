<?php

    namespace App\Pokemon\Attaques;

    use App\Pokemon\Type;
    use App\Pokemon\Type\EauType;
    use App\Pokemon\Type\FeuType;

    abstract class Attaque implements AttaqueInterface
    {
        private string $nom;
        private int $degats;
        private Type $type;

        public function __construct(
            string $nom,
            int $degats,
            Type $type
        ) {
            $this->nom = $nom;
            $this->degats = $degats;
            $this->type = $type;
        }

        public function getNom(): string
        {
            return $this->nom;
        }

        public function getDegats(): int
        {
            return $this->degats;
        }

        public function getType(): Type
        {
            return $this->type;
        }

    }