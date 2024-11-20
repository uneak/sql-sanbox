<?php

    $servername = "db";
    $username = "app";
    $password = "app";
    $dbname = "workhive";

    try {

        // Création de la connexion
        $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);

        // Configuration pour afficher les erreurs PDO
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        echo "Connexion réussie à la base de données";
    } catch (PDOException $e) {
        echo "Erreur de connexion : " . $e->getMessage();
    }
