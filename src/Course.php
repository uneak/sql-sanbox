<?php

    class Course
    {
        public array $cars;
        public array $podium;
        public float $arrivee;
        public string $status = "en attente"; // "en cours", "fini"

        public function __construct(int $nbParticipants, float $arrivee)
        {

            $marques = [
                "Peugeot",
                "Renault",
                "Citroen",
                "BMW",
                "Mercedes",
                "Audi",
                "Volkswagen",
                "Fiat",
                "Ford",
                "Opel",
            ];

            $cars = [];
            for ($i = 0; $i < $nbParticipants; $i++) {
                $cars[] = new Car($marques[rand(0, count($marques)-1)], "Participant " . $i, rand(1, 3));
            }


            $this->cars = $cars;
            $this->arrivee = $arrivee;
            $this->status = "en attente";
        }

        /**
         * Démarre la course
         *
         * @return bool retourne true si la course a bien démarré, false sinon
         */
        public function start() : bool
        {
            if ($this->status === "en cours") {
                echo "La course est déjà en cours !<br/>";
                return false;
            }

            if ($this->status === "fini") {
                echo "La course est déjà finie !<br/>";
                return false;
            }

            $this->status = "en cours";
            $this->podium = [];
            echo "La course commence !<br/>";


            $i = 0;
            while ($this->status !== "fini") {
                foreach ($this->cars as $car) {
                    $this->avancer($car, rand(1, 10));
                }
                if ($this->status !== "fini") {
                    if ($i % 3 === 0) {
                        $this->showCourse();
                    }
                    $i++;
                }
            }

            return true;
        }


        /**
         * Fait avancer une voiture
         *
         * @param \Car  $car
         * @param float $step
         *
         * @return void
         */
        public function avancer(Car $car, float $step) : void {
            if ($car->getPosition() >= $this->arrivee) {
                return;
            }


            if ($this->status === "fini") {
                echo "La course est déjà finie !<br/>";
                return;
            }

            if ($this->status === "en attente") {
                echo "La course n'a pas commencé !<br/>";
                return;
            }

            if ($car->getPosition() >= $this->arrivee) {
                return;
            }

            $car->avancer($step);

            if ($car->getPosition() >= $this->arrivee) {
                echo $car->nom . " a gagné !<br/>";
                $this->podium[] = $car;
            }


            $allArrivee = true;
            foreach ($this->cars as $car) {
                if ($car->getPosition() < $this->arrivee) {
                    $allArrivee = false;
                    break;
                }
            }

            if ($allArrivee) {
                $this->status = "fini";
                $this->showPodium();
            }
        }


        public function showCourse() : void {
            echo "<br/>############ <br/>";
            echo sprintf("Ligne d\'arrivée : %f<br/>", $this->arrivee);
            echo "Positions des voitures : <br/>";
            /** @var Car $car */
            foreach ($this->cars as $car) {
                echo sprintf("%s (%s) : %f<br/>", $car->nom, $car->marque, $car->getPosition());
            }
            echo "############ <br/><br/>";
        }

        public function showPodium() : void {
            echo "<br/>############ <br/>";
            echo "Podium : <br/>";
            for ($i = 0; $i < count($this->podium); $i++) {
                echo ($i + 1) . " : " . $this->podium[$i]->nom . "<br/>";
            }
            echo "############ <br/><br/>";
        }

    }