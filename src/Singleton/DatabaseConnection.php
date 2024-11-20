<?php

    namespace App\Singleton;

    use PDO;
    use PDOException;

    class DatabaseConnection
    {
        private PDO $connection;

        public function __construct()
        {
            $config = Configuration::getInstance();

            $host = $config->get("database.host");
            $dbname = $config->get("database.dbname");
            $username = $config->get("database.username");
            $password = $config->get("database.password");

            try {
                $this->connection = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die("Erreur de connexion : " . $e->getMessage());
            }
        }


        public function getConnection(): PDO
        {
            return $this->connection;
        }
    }