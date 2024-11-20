<?php

    namespace App\Pokemon;

    use App\Logger\Logger;
    use App\Pokemon\Attaques\AttaqueInterface;
    use App\Pokemon\Exception\InvalidAttackException;

    abstract class Pokemon
    {
        protected Type $type;

        public function __construct(
            protected string $name,
            protected float $niveau = 1,
            protected float $energy = 100
        ) {
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getType(): Type
        {
            return $this->type;
        }

        public function getNiveau(): float
        {
            return $this->niveau;
        }

        public function getEnergy(): float
        {
            return $this->energy;
        }

        public function subir(AttaqueInterface $attaque): void
        {

            $degat = 0;
            foreach ($this->getFaiblesses() as $faiblesse) {
                if ($attaque->getType()->getName() === $faiblesse->getName()) {
                    $degat = $attaque->getDegats() * 2;
                }
            }

            if ($degat === 0) {
                $degat = $attaque->getDegats();
            }

            $this->energy -= $degat;

            if ($this->energy <= 0) {
                echo "$this->name est KO<br/>";
            } else {

                $message = sprintf(
                    "%s a subi une attaque %s de type %s et a maintenant %f points d'énergie<br/>",
                    $this->name,
                    $attaque->getNom(),
                    $attaque->getType()->getName(),
                    $this->energy
                );

                Logger::getInstance()->log($message);
                echo $message;
            }
        }

        /**
         * @throws \Exception
         */
        public function attaquer(Pokemon $pokemon, string $nomAttaque): void
        {
            foreach ($this->getAttaques() as $attaque) {
                if ($attaque->getNom() === $nomAttaque) {
                    $pokemon->subir($attaque);
                    return;
                }
            }

            throw new InvalidAttackException($this, $pokemon, $nomAttaque);
        }


        public function showInfos(): string
        {
            $returnLines = [];
            $returnLines[] = sprintf(
                'Nom: %s <br/> Type: %s <br/> Niveau: %.0f<br/> Energy: %f<br/>',
                $this->name, $this->type->getName(), $this->niveau, $this->energy
            );


            $str = "Attaques: <ul>";
            foreach ($this->getAttaques() as $attaque) {
                $str = $str . "<li>nom: ".$attaque->getNom() . ", degat:" . $attaque->getDegats() ."</li>";
            }
            $returnLines[] = $str . "</ul>";


            $str = "Faiblesses: <ul>";
            foreach ($this->getFaiblesses() as $type) {
                $str = $str . "<li>" . $type->getName() . "</li>";
            }
            $returnLines[] = $str . "</ul>";


            $returnLines[] = '<hr/>';

            return join('<br/>', $returnLines);

            //            return "Nom: $this->name - Type: $this->type - Niveau: $this->niveau";
        }


        public function updgadeNiveau(float $nbPoint): void
        {
            $this->niveau += $nbPoint;
            echo "Le niveau de $this->name est maintenant de $this->niveau<br/>";
        }

        /**
         * @return array<AttaqueInterface>
         */
        abstract public function getAttaques(): array;

        /**
         * @return array<Type>
         */
        abstract public function getFaiblesses(): array;


    }