<?php

    $montantAchat = 250;

    $reduction = match (true) {
        $montantAchat >= 500 => 20,
        $montantAchat >= 200 => 10,
        $montantAchat >= 100 => 5,
        default => 0
    };

    $montantReduction = $montantAchat * $reduction / 100;

    echo "<br/>Montant initial de l'achat : " . $montantAchat;
    echo "<br/>Pourcentage de réduction appliqué : " . $reduction . "%";
    echo "<br/>Montant de la réduction : " . $montantReduction;
    echo "<br/>Montant final après réduction : " . $montantAchat - $montantReduction;