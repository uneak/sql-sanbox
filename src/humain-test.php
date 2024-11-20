<?php
    include 'Humain.php';
    include 'Homme.php';
    include 'Femme.php';

    $humain = new Humain("Gary", 30, "Masculin", "Africaine");
    $marc = new Homme("Marc", 22, "Africaine");
    $drucila = new Femme("Drucila", 30, "Africaine");


    $humain->parler();
    $humain->courir();
    $humain->manger();
    $humain->dormir();
    $humain->caca();
    $humain->pipi();

    $drucila->parler();
    $drucila->courir();
    $drucila->manger();
    $drucila->dormir();
    $drucila->caca();
    $drucila->pipi();
    $drucila->seMaquille();

    $marc->parler();
    $marc->courir();
    $marc->manger();
    $marc->dormir();
    $marc->caca();
    $marc->pipi();
    $marc->seRase();