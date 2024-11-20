<?php

    namespace App\Pokemon\Pokemon;

    use App\Pokemon\Attaques\HydroCanon;
    use App\Pokemon\Attaques\PistoletAEau;
    use App\Pokemon\Pokemon;
    use App\Pokemon\Type\EauType;
    use App\Pokemon\Type\ElectriqueType;
    use App\Pokemon\Type\FeuType;

    class EauPokemon extends Pokemon
    {

        public function __construct(string $name, float $niveau = 1)
        {
            $this->type = new EauType();
            parent::__construct($name, $niveau);
        }

        public function getAttaques(): array
        {
            return [
                new PistoletAEau(),
                new HydroCanon()
            ];
        }

        public function getFaiblesses(): array
        {
            return [
                new FeuType(),
                new ElectriqueType()
            ];
        }
    }