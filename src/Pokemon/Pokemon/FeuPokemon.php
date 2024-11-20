<?php

    namespace App\Pokemon\Pokemon;

    use App\Pokemon\Attaques\Flammeche;
    use App\Pokemon\Attaques\LanceFlamme;
    use App\Pokemon\Pokemon;
    use App\Pokemon\Type\EauType;
    use App\Pokemon\Type\FeuType;
    use App\Pokemon\Type\RocheType;

    class FeuPokemon extends Pokemon
    {
        public function __construct(string $name, float $niveau = 1)
        {
            $this->type = new FeuType();
            parent::__construct($name, $niveau);
        }

        public function getAttaques(): array
        {
            return [
                new Flammeche(),
                new LanceFlamme()
            ];
        }

        public function getFaiblesses(): array
        {
            return [
                new EauType(),
                new RocheType()
            ];
        }
    }