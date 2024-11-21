<?php

    namespace App\Models;

    use App\Services\DatabaseConnection;
    use DateTime;
    use PDO;

    class RoomManager
    {
        private PDO $connection;

        public function __construct()
        {
            $this->connection = DatabaseConnection::getInstance()->getConnection();
        }

        /**
         * Trouve une salle par son ID.
         *
         * @throws \Exception
         */
        public function findById(int $id): Room
        {
            try {
                $query = $this->connection->prepare("SELECT * FROM Rooms WHERE id = :id");
                $query->execute(['id' => $id]);
                $room = $query->fetch(PDO::FETCH_ASSOC);

                if (!$room) {
                    throw new \Exception("Salle non trouvée.");
                }

                return $this->mapToRoom($room);
            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la récupération de la salle : " . $e->getMessage());
            }
        }

        public function getPriceByRole(int $roomId, string $role): ?int
        {
            $query = $this->connection->prepare("SELECT hourly_rate FROM `Room_Role_Rate` WHERE room_id = :room_id AND user_role= :user_role");
            $query->execute(['room_id' => $roomId, 'user_role' => $role]);
            $price = $query->fetch(PDO::FETCH_COLUMN);
            return $price === false ? null : $price;
        }

        /**
         * Récupère toutes les salles.
         *
         * @param int   $limit
         * @param int   $offset
         * @param array $filters
         *
         * @return Room[]
         */
        public function findAll(int $limit = 10, int $offset = 0, array $filters = []): array
        {
            $whereClauses = [];
            $params = [];

            if (!empty($filters['status'])) {
                $whereClauses[] = "status = :status";
                $params['status'] = $filters['status'];
            }

            $whereSql = $whereClauses ? 'WHERE ' . join(' AND ', $whereClauses) : '';

            $query = $this->connection->prepare("
                SELECT * FROM Rooms $whereSql LIMIT :limit OFFSET :offset
            ");

            foreach ($params as $key => $value) {
                $query->bindValue(":$key", $value);
            }

            $query->bindValue(':limit', $limit, PDO::PARAM_INT);
            $query->bindValue(':offset', $offset, PDO::PARAM_INT);
            $query->execute();

            $rooms = $query->fetchAll(PDO::FETCH_ASSOC);

            return array_map([$this, 'mapToRoom'], $rooms);
        }

        /**
         * Crée une nouvelle salle.
         *
         * @throws \Exception
         */
        public function create(Room|array $room): Room
        {
            $query = $this->connection->prepare("
                INSERT INTO Rooms (name, capacity, width, length, status, description, photo, created_at, updated_at)
                VALUES (:name, :capacity, :width, :length, :status, :description, :photo, :created_at, :updated_at)
            ");

            $room = is_array($room) ? $room : [
                'name'        => $room->getName(),
                'capacity'    => $room->getCapacity(),
                'width'       => $room->getWidth(),
                'length'      => $room->getLength(),
                'status'      => $room->getStatus(),
                'description' => $room->getDescription(),
                'photo'       => $room->getPhoto(),
            ];

            $this->validateRoomData($room);

            $room['created_at'] = (new DateTime())->format('Y-m-d H:i:s');
            $room['updated_at'] = (new DateTime())->format('Y-m-d H:i:s');

            $query->execute($room);
            $room['id'] = $this->connection->lastInsertId();

            return $this->mapToRoom($room);
        }

        /**
         * Met à jour une salle existante.
         *
         * @throws \Exception
         */
        public function update(Room|int $idOrRoom, array $data): bool
        {
            if (is_int($idOrRoom)) {
                $id = $idOrRoom;
            } else {
                $id = $idOrRoom->getId();

                $data = [
                    'name'        => $idOrRoom->getName(),
                    'capacity'    => $idOrRoom->getCapacity(),
                    'width'       => $idOrRoom->getWidth(),
                    'length'      => $idOrRoom->getLength(),
                    'status'      => $idOrRoom->getStatus(),
                    'description' => $idOrRoom->getDescription(),
                    'photo'       => $idOrRoom->getPhoto(),
                    ...$data,
                ];
            }

            $this->validateRoomData($data);

            $data['updated_at'] = (new DateTime())->format('Y-m-d H:i:s');

            $queryModifier = [];
            foreach (array_keys($data) as $key) {
                $queryModifier[$key] = $key . " = :" . $key;
            }

            $query = $this->connection->prepare(
                "UPDATE Rooms SET " . join(', ', $queryModifier) . " WHERE id = :id"
            );

            $query->execute([...$data, 'id' => $id]);

            return $query->rowCount() > 0;
        }

        /**
         * Supprime une salle par son ID.
         *
         * @throws \Exception
         */
        public function delete(Room|int $idOrRoom): bool
        {
            try {
                $query = $this->connection->prepare("DELETE FROM Rooms WHERE id = :id");
                $query->execute(['id' => is_int($idOrRoom) ? $idOrRoom : $idOrRoom->getId()]);

                return $query->rowCount() > 0;
            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la suppression de la salle : " . $e->getMessage());
            }
        }

        /**
         * Map un tableau associatif en un objet Room.
         *
         * @throws \Exception
         */
        private function mapToRoom(array $room): Room
        {
            return new Room(
                $room['id'],
                $room['name'],
                $room['capacity'],
                $room['width'],
                $room['length'],
                $room['status'],
                $room['description'],
                $room['photo'],
                new DateTime($room['created_at']),
                new DateTime($room['updated_at'])
            );
        }

        /**
         * Valide les données d'une salle.
         *
         * @throws \Exception
         */
        private function validateRoomData(array $data): void
        {
            if (empty($data['name'])) {
                throw new \Exception("Le nom de la salle est obligatoire.");
            }

            if (!isset($data['capacity']) || $data['capacity'] <= 0) {
                throw new \Exception("La capacité doit être un nombre positif.");
            }

            if (!isset($data['width']) || $data['width'] <= 0) {
                throw new \Exception("La largeur doit être un nombre positif.");
            }

            if (!isset($data['length']) || $data['length'] <= 0) {
                throw new \Exception("La longueur doit être un nombre positif.");
            }

            if (!isset($data['status']) || !in_array($data['status'], ['available', 'unavailable'], true)) {
                throw new \Exception("Le statut de la salle est invalide.");
            }
        }
    }
