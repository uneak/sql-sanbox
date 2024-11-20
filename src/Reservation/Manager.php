<?php

    namespace App\Reservation;

    class Manager
    {
        private \PDO $conn;

        public function __construct() {
            $databaseConnection = DatabaseConnection::getInstance();
            $this->conn = $databaseConnection->getConnection();
        }


        public function findById(int $id): string
        {
            $sql = "SELECT * FROM Users WHERE id = " . $id;

            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $results = $statement->fetch(\PDO::FETCH_ASSOC);

            return $sql;
        }


        /**
         * @param array{
         *     first_name: string,
         *     last_name: string,
         *     photo: string|null,
         *     user_role: string,
         *     phone: string|null,
         *     email: string,
         *     password: string,
         *     status: string,
         * } $data
         *
         * @return string
         */
        public function create(array $data): string
        {
            $sql = "INSERT INTO Users (first_name, last_name, photo, user_role, phone, email, password, status, created_at, updated_at)";
            $sql .= "VALUES (";
            $sql .= "\"" . $data['first_name'] . "\", ";
            $sql .= "\"" .$data['last_name'] . "\", ";
            $sql .= (isset($data['photo']) && $data['photo'] !== null) ? "\"" .$data['photo'] . "\", " : "null, ";
            $sql .= "\"" .$data['user_role'] . "\", ";
            $sql .= "\"" .$data['phone'] . "\", ";
            $sql .= "\"" .$data['email'] . "\", ";
            $sql .= "\"" .$data['password'] . "\", ";
            $sql .= "\"" .$data['status'] . "\", ";
            $sql .= "current_timestamp(), ";
            $sql .= "current_timestamp()";
            $sql .= ")";

            $statement = $this->conn->prepare($sql);
            $statement->execute();

            $id = $this->conn->lastInsertId();

            return $sql;
        }

        /**
         * @param int $id
         * @param array{
         *     first_name: string,
         *     last_name: string,
         *     photo: string|null,
         *     user_role: string,
         *     phone: string|null,
         *     email: string,
         *     password: string,
         *     status: string,
         * }          $data
         *
         * @return string
         */
        public function update(int $id, array $data): string
        {
            $sql = "UPDATE Users SET ";
            if (isset($data['first_name'])) {
                $sql .= "first_name = \"" . $data['first_name'] . "\", ";
            }
            if (isset($data['last_name'])) {
                $sql .= "last_name = \"" . $data['last_name'] . "\", ";
            }

            if (array_key_exists("photo", $data)) {
                $sql .= $data['photo'] !== null ? "photo = \"" . $data['photo'] . "\", " : "photo = null, ";
            }
            if (isset($data['user_role'])) {
                $sql .= "user_role = \"" . $data['user_role'] . "\", ";
            }
            if (isset($data['phone'])) {
                $sql .= "phone = \"" . $data['phone'] . "\", ";
            }
            if (isset($data['email'])) {
                $sql .= "email = \"" . $data['email'] . "\", ";
            }
            if (isset($data['password'])) {
                $sql .= "password = \"" . $data['password'] . "\", ";
            }
            if (isset($data['status'])) {
                $sql .= "status = \"" . $data['status'] . "\", ";
            }

            $sql .= "updated_at = current_timestamp() ";
            $sql .= "WHERE id = " . $id;

            $statement = $this->conn->prepare($sql);
            $statement->execute();

            return $sql;
        }

        public function delete(int $id): string
        {
            $sql = "DELETE FROM Users WHERE id = " . $id;

            $statement = $this->conn->prepare($sql);
            $statement->execute();

            return $sql;
        }

        public function findAll(): string
        {
            $sql = "SELECT * FROM Users";

            $statement = $this->conn->prepare($sql);
            $statement->execute();
            $results = $statement->fetchAll(\PDO::FETCH_ASSOC);

            var_dump($results);

            return $sql;
        }
    }