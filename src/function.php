<?php

    /**
     * Calcule la surface d'un rectangle
     *
     * @param float $longueur
     * @param float $largeur
     *
     * @return float
     */
    function surface(float $longueur, float $largeur) : float {
        return $longueur * $largeur;
    }

    /**
     * Détermine la taille d'un rectangle en fonction de sa surface
     *
     * @param float $surface
     *
     * @return string
     */
    function taille(float $surface) : string {
        return match (true) {
           $surface < 100 => "petit",
           $surface <= 500 => "moyen",
           default => "grand"
       };
    }

    echo taille(surface(100, 10));









