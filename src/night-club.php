<?php

    function verifierAccesEtape1($nombrePersonnes) {
        if ($nombrePersonnes > 50) {
            echo "Accès refusé : Le nombre de personnes dépasse la capacité de la salle.";
        } else {
            echo "Accès autorisé.";
        }
        echo "<br/>";
    }

    function verifierAccesEtape2($nombrePersonnes, $status) {
        if (
            ($nombrePersonnes > 50) ||
            ($status == "utilisateur normal" && $nombrePersonnes > 30)
        ) {
            echo "Accès refusé : Le nombre de personnes dépasse la capacité de la salle.";
        } else {
            echo "Accès autorisé.";
        }
        echo "<br/>";
    }

    function verifierAccesEtape3($nombrePersonnes, $statut, $dureeReservation) {
        if (
            ($nombrePersonnes > 50) ||
            ($statut == "utilisateur normal" && $nombrePersonnes > 30) ||
            ($statut == "membre" && $dureeReservation > 6) ||
            ($statut == "utilisateur normal" && $dureeReservation > 3)
        ) {
            echo "Accès refusé : Le nombre de personnes dépasse la capacité de la salle ou la durée de réservation est trop longue.";
        } else {
            echo "Accès autorisé.";
        }

        echo "<br/>";
    }

foreach (range(1, 3) as $etape) {

    $team = [
        "marc",
        "drucila",
        "agnes",
        "gary",
        "marie helene"
    ];


    for($i = 0; $i < 5 ; $i++)
    {
        echo $team[$i] . "<br/>";
    }

    explode('')
//
//    echo $team[0] . "<br/>";
//    echo $team[1] . "<br/>";
//    echo $team[2] . "<br/>";
//    echo $team[3] . "<br/>";
//    echo $team[4] . "<br/>";

