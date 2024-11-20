<?php

    namespace App\Pokemon\Pokemon;

    use App\Pokemon\Attaques\TempeteVerte;
    use App\Pokemon\Attaques\TranchHerbe;
    use App\Pokemon\Pokemon;
    use App\Pokemon\Type\FeuType;
    use App\Pokemon\Type\GlaceType;
    use App\Pokemon\Type\PlanteType;

    class PlantePokemon extends Pokemon
    {

        public function __construct(string $name, float $niveau = 1)
        {
            $this->type = new PlanteType();
            parent::__construct($name, $niveau);
        }

        public function getAttaques(): array
        {
            return [
                new TranchHerbe(),
                new TempeteVerte()
            ];
        }

        public function getFaiblesses(): array
        {
            return [
                new FeuType(),
                new GlaceType()
            ];
        }
    }