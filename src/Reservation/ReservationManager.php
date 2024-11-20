<?php

    namespace App\Reservation;

    use DateTime;
    use PDO;

    class ReservationManager
    {
        private PDO $connection;
        private UserManager $userManager;
        private RoomManager $roomManager;

        public function __construct()
        {
            $this->connection = DatabaseConnection::getInstance()->getConnection();
            $this->userManager = new UserManager();
            $this->roomManager = new RoomManager();
        }

        /**
         * Crée une réservation.
         *
         * @throws \Exception
         */
        public function createReservation(Room $room, User $user, DateTime $start_at, DateTime $end_at): Reservation
        {
            $data = [
                'room_id'    => $room->getId(),
                'user_id'    => $user->getId(),
                'start_at'   => $start_at->format('Y-m-d H:i:s'),
                'end_at'     => $end_at->format('Y-m-d H:i:s'),
                'status'     => 'pending',
                'created_at' => (new DateTime())->format('Y-m-d H:i:s'),
                'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
            ];

            $this->validateReservationData($data);

            try {
                $this->connection->beginTransaction();

                $query = $this->connection->prepare("
                    INSERT INTO Reservations (room_id, user_id, start_at, end_at, status, created_at, updated_at)
                    VALUES (:room_id, :user_id, :start_at, :end_at, :status, :created_at, :updated_at)
                ");
                $query->execute($data);

                $data['id'] = $this->connection->lastInsertId();

                $this->connection->commit();

                return $this->createReservationObject($data);
            } catch (\Exception $e) {
                $this->connection->rollBack();
                throw new \Exception("Erreur lors de la création de la réservation : " . $e->getMessage());
            }
        }

        /**
         * Annule une réservation.
         *
         * @throws \Exception
         */
        public function cancelReservation(int $id): bool
        {
            try {
                $reservation = $this->findById($id);
                if (!$reservation) {
                    throw new \Exception("Réservation non trouvée.");
                }

                $query = $this->connection->prepare("
                    UPDATE Reservations 
                    SET status = :status, updated_at = :updated_at 
                    WHERE id = :id
                ");
                $query->execute([
                    'status'     => 'cancelled',
                    'updated_at' => (new DateTime())->format('Y-m-d H:i:s'),
                    'id'         => $id,
                ]);

                return $query->rowCount() > 0;
            } catch (\Exception $e) {
                throw new \Exception("Erreur lors de l'annulation de la réservation : " . $e->getMessage());
            }
        }

        /**
         * Supprime une réservation.
         *
         * @throws \Exception
         */
        public function removeReservation(int $id): bool
        {
            try {
                $query = $this->connection->prepare("DELETE FROM Reservations WHERE id = :id");
                $query->execute(['id' => $id]);

                return $query->rowCount() > 0;
            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la suppression de la réservation : " . $e->getMessage());
            }
        }

        /**
         * Trouve une réservation par son ID.
         *
         * @throws \Exception
         */
        public function findById(int $id): ?Reservation
        {
            try {
                $query = $this->connection->prepare("SELECT * FROM Reservations WHERE id = :id");
                $query->execute(['id' => $id]);
                $reservation = $query->fetch(PDO::FETCH_ASSOC);

                return $reservation ? $this->createReservationObject($reservation) : null;
            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la récupération de la réservation : " . $e->getMessage());
            }
        }

        /**
         * Récupère toutes les réservations avec pagination.
         */
        public function findAll(int $limit = 10, int $offset = 0, array $filters = []): array
        {
            $sql = "SELECT * FROM Reservations WHERE 1=1";
            $params = ['limit' => $limit, 'offset' => $offset];

            if (!empty($filters['status'])) {
                $sql .= " AND status = :status";
                $params['status'] = $filters['status'];
            }

            if (!empty($filters['user_id'])) {
                $sql .= " AND user_id = :user_id";
                $params['user_id'] = $filters['user_id'];
            }

            if (!empty($filters['room_id'])) {
                $sql .= " AND room_id = :room_id";
                $params['room_id'] = $filters['room_id'];
            }

            if (!empty($filters['date']) && $filters['date'] instanceof DateTime) {
                $sql .= " AND :date BETWEEN start_at AND end_at";
                $params['date'] = $filters['date']->format('Y-m-d H:i:s');
            }

            $sql .= " LIMIT :limit OFFSET :offset";

            $query = $this->connection->prepare($sql);

            foreach ($params as $key => $value) {
                $query->bindValue(":$key", $value);
            }

            $query->execute();

            $results = $query->fetchAll(PDO::FETCH_ASSOC);
            return array_map([$this, 'createReservationObject'], $results);
        }

        /**
         * Valide les données d'une réservation.
         *
         * @throws \Exception
         */
        private function validateReservationData(array $data): void
        {
            if (empty($data['room_id']) || !$this->roomManager->findById($data['room_id'])) {
                throw new \Exception("Salle invalide ou introuvable.");
            }

            if (empty($data['user_id']) || !$this->userManager->findById($data['user_id'])) {
                throw new \Exception("Utilisateur invalide ou introuvable.");
            }

            if (new DateTime($data['start_at']) >= new DateTime($data['end_at'])) {
                throw new \Exception("La date de début doit être antérieure à la date de fin.");
            }
        }

        /**
         * Crée un objet Reservation à partir des données.
         *
         * @throws \Exception
         */
        private function createReservationObject(array $reservation): Reservation
        {
            return new Reservation(
                $reservation['id'],
                $this->roomManager->findById($reservation['room_id']),
                $this->userManager->findById($reservation['user_id']),
                new DateTime($reservation['start_at']),
                new DateTime($reservation['end_at']),
                $reservation['status'],
                new DateTime($reservation['created_at']),
                new DateTime($reservation['updated_at'])
            );
        }
    }
