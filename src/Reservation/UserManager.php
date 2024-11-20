<?php

    namespace App\Reservation;

    use DateTime;
    use PDO;

    class UserManager
    {
        private PDO $connection;

        public function __construct()
        {
            $this->connection = DatabaseConnection::getInstance()->getConnection();
        }

        /**
         * Trouve un utilisateur par son ID.
         *
         * @throws \Exception
         */
        public function findById(int $id): User
        {
            try {
                $query = $this->connection->prepare("SELECT * FROM Users WHERE id = :id");
                $query->execute(['id' => $id]);
                $user = $query->fetch(PDO::FETCH_ASSOC);

                if (!$user) {
                    throw new \Exception("Utilisateur non trouvé.");
                }

                return $this->mapToUser($user);
            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
            }
        }



        /**
         * Récupère tous les utilisateurs.
         *
         * @return User[]
         */
        public function findAll(int $limit = 10, int $offset = 0, array $filters = []): array
        {
            $whereClauses = [];
            $params = [];

            if (!empty($filters['user_role'])) {
                $whereClauses[] = "user_role = :user_role";
                $params['user_role'] = $filters['user_role'];
            }

            if (!empty($filters['status'])) {
                $whereClauses[] = "status = :status";
                $params['status'] = $filters['status'];
            }

            $whereSql = $whereClauses ? 'WHERE ' . join(' AND ', $whereClauses) : '';

            $query = $this->connection->prepare("
                SELECT * FROM Users $whereSql LIMIT :limit OFFSET :offset
            ");

            foreach ($params as $key => $value) {
                $query->bindValue(":$key", $value);
            }

            $query->bindValue(':limit', $limit, PDO::PARAM_INT);
            $query->bindValue(':offset', $offset, PDO::PARAM_INT);

            $query->execute();

            $users = $query->fetchAll(PDO::FETCH_ASSOC);

            return array_map([$this, 'mapToUser'], $users);
        }

        /**
         * Crée un nouvel utilisateur.
         *
         * @throws \Exception
         */
        public function create(User|array $user): User
        {
            $query = $this->connection->prepare("
                INSERT INTO Users (first_name, last_name, photo, user_role, phone, email, password, status, created_at, updated_at)
                VALUES (:first_name, :last_name, :photo, :user_role, :phone, :email, :password, :status, :created_at, :updated_at)
            ");

            $user = is_array($user) ? $user : [
                'first_name' => $user->getFirstName(),
                'last_name'  => $user->getLastName(),
                'photo'      => $user->getPhoto(),
                'user_role'  => $user->getUserRole(),
                'phone'      => $user->getPhone(),
                'email'      => $user->getEmail(),
                'password'   => $user->getPassword(),
                'status'     => $user->getStatus(),
            ];


            $this->validateUserData($user);

            $user['created_at'] = (new DateTime())->format('Y-m-d H:i:s');
            $user['updated_at'] = (new DateTime())->format('Y-m-d H:i:s');

            $query->execute($user);
            $user['id'] = $this->connection->lastInsertId();

            return $this->mapToUser($user);
        }

        /**
         * Met à jour un utilisateur existant.
         *
         * @throws \Exception
         */
        public function update(User|int $idOrUser, ?array $data = null): bool
        {
            if (is_int($idOrUser)) {
                $id = $idOrUser;

                if ($data === null) {
                    throw new \Exception("Les données de l'utilisateur sont requises pour la mise à jour.");
                }
            } else {
                $id = $idOrUser->getId();

                $data = [
                    'first_name' => $idOrUser->getFirstName(),
                    'last_name'  => $idOrUser->getLastName(),
                    'photo'      => $idOrUser->getPhoto(),
                    'user_role'  => $idOrUser->getUserRole(),
                    'phone'      => $idOrUser->getPhone(),
                    'email'      => $idOrUser->getEmail(),
                    'password'   => $idOrUser->getPassword(),
                    'status'     => $idOrUser->getStatus(),
                    ...($data !== null) ? $data : [],
                ];
            }

            $this->validateUserData($data);

            $data['updated_at'] = (new DateTime())->format('Y-m-d H:i:s');

            $queryModifier = [];
            foreach (array_keys($data) as $key) {
                $queryModifier[$key] = $key . " = :" . $key;
            }

            $query = $this->connection->prepare(
                "UPDATE Users SET " . join(', ', $queryModifier) . " WHERE id = :id"
            );

            $query->execute([...$data, 'id' => $id]);
            return $query->rowCount() > 0;
        }

        /**
         * Supprime un utilisateur par son ID.
         *
         * @throws \Exception
         */
        public function delete(User|int $idOrUser): bool
        {
            try {
                $query = $this->connection->prepare("DELETE FROM Users WHERE id = :id");
                $query->execute(['id' => is_int($idOrUser) ? $idOrUser : $idOrUser->getId()]);

                return $query->rowCount() > 0;

            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la suppression de l'utilisateur : " . $e->getMessage());
            }
        }

        /**
         * Map un tableau associatif en un objet User.
         *
         * @throws \Exception
         */
        private function mapToUser(array $user): User
        {
            return new User(
                $user['id'],
                $user['first_name'],
                $user['last_name'],
                $user['photo'],
                $user['user_role'],
                $user['phone'],
                $user['email'],
                $user['password'],
                $user['status'],
                new DateTime($user['created_at']),
                new DateTime($user['updated_at'])
            );
        }

        /**
         * @throws \Exception
         */
        private function validateUserData(array $data): void
        {
            if (empty($data['first_name'])) {
                throw new \Exception("Le prénom est obligatoire.");
            }

            if (empty($data['last_name'])) {
                throw new \Exception("Le nom est obligatoire.");
            }

            if (!isset($data['user_role']) || !in_array($data['user_role'], ['admin', 'user', 'member'], true)) {
                throw new \Exception("Le rôle utilisateur est invalide.");
            }

            if (!isset($data['status']) || !in_array($data['status'], ['active', 'inactive'], true)) {
                throw new \Exception("Le statut utilisateur est invalide.");
            }

            if (isset($data['email']) && !filter_var($data['email'], FILTER_VALIDATE_EMAIL)) {
                throw new \Exception("L'adresse e-mail est invalide.");
            }

            if (isset($data['password']) && strlen($data['password']) < 6) {
                throw new \Exception("Le mot de passe doit contenir au moins 6 caractères.");
            }
        }
    }
