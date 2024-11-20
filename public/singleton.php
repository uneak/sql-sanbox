<?php

    require __DIR__ . '/../vendor/autoload.php';

    use App\Singleton\DatabaseConnection;

    $database = new DatabaseConnection();
    $conn = $database->getConnection();

    try {
        // Exécuter une requête de sélection simple
        $query = $conn->query('SELECT * FROM Users');

        $results = $query->fetchAll(PDO::FETCH_ASSOC);
        foreach ($results as $row) {
            echo $row['first_name'] . ' ' . $row['last_name'] . '<br>';
        }

        var_dump($results);

    } catch (PDOException $e) {
        echo "Erreur lors de l'exécution de la requête : " . $e->getMessage();
    }

