<?php

    require 'Chien.php';


    $boule = new Chien();
    $boule->nom = 'Boule';
    $boule->aboyer();
    echo $boule->energy . "<br/>";
    $boule->aboyer();
    $boule->aboyer();
    $boule->manger('viande');
    echo $boule->energy . "<br/>";
    $boule->aboyer();
    $boule->aboyer();
    $boule->leverLaPatte();
    $boule->manger('os');
    $boule->manger('os');
    $boule->leverLaPatte();


    $oscar = new Chien();
    $oscar->nom = 'Oscar';
    $oscar->aboyer();
    $oscar->aboyer();
    $oscar->aboyer();
    $oscar->aboyer();
    $oscar->aboyer();

    var_dump($oscar);