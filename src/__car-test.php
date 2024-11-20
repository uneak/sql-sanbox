<?php

    require "Car.php";


    function showCourse(array $cars, float $arrivee) : void {
        echo "<br/>############ <br/>";
        echo sprintf("Ligne d\'arrivée : %f<br/>", $arrivee);
        echo "--- <br/>";
        echo "Positions des voitures : <br/>";
        foreach ($cars as $car) {
            echo $car->nom . " : " . $car->position . "<br/>";
        }
        echo "--- <br/>";
        foreach ($cars as $car) {
            if ($car->position >= $arrivee) {
                echo $car->nom . " a gagné !<br/>";
                return;
            }
        }
        echo "############ <br/><br/>";
    }

    $peugeot = new Car();
    $peugeot->nom = 'Peugeot';
    $peugeot->vitesse = 200;

    $bmw = new Car();
    $bmw->nom = 'BMW';
    $bmw->vitesse = 20;

    $mer = new Car();
    $mer->nom = 'Mercedess';
    $mer->vitesse = 10;

    $bmw->avancer(5);
    $mer->avancer(6);

    showCourse([$bmw, $mer, $peugeot], 1000);

    $bmw->avancer(2);
    $mer->avancer();
    $bmw->avancer(3);

    showCourse([$bmw, $mer, $peugeot], 1000);

    $mer->avancer(40);
    $mer->avancer();

    showCourse([$bmw, $mer, $peugeot], 1000);

    $peugeot->avancer(3);
    $bmw->avancer(3);
    $mer->avancer(5);

    showCourse([$bmw, $mer, $peugeot], 1000);

    $bmw->avancer(30);
    $mer->reculer(30);

    showCourse([$bmw, $mer, $peugeot], 1000);

    $bmw->avancer(10);
    $mer->reculer(3);

    showCourse([$bmw, $mer, $peugeot], 1000);
