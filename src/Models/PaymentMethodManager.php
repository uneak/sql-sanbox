<?php

    namespace App\Models;

    use App\Payment\PaymentFactory;
    use App\Payment\PaymentOptionsFactory;
    use App\Services\DatabaseConnection;
    use DateTime;
    use PDO;

    class PaymentMethodManager
    {
        private PDO $connection;
        private UserManager $userManager;
        private PaymentFactory $paymentFactory;

        public function __construct()
        {
            $this->connection = DatabaseConnection::getInstance()->getConnection();
            $this->userManager = new UserManager();
            $this->paymentFactory = new PaymentFactory();
        }

        /**
         * Trouve un utilisateur par son ID.
         *
         * @throws \Exception
         */
        public function findById(int $id): PaymentMethod
        {
            try {
                $query = $this->connection->prepare("SELECT * FROM Payment_Method WHERE id = :id");
                $query->execute(['id' => $id]);
                $paymentMethod = $query->fetch(PDO::FETCH_ASSOC);

                if (!$paymentMethod) {
                    throw new \Exception("Methode de paiement non trouvé.");
                }

                return $this->mapToPaymentMethod($paymentMethod);
            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la récupération de l'utilisateur : " . $e->getMessage());
            }
        }


        /**
         * Récupère tous les utilisateurs.
         *
         * @return PaymentMethod[]
         */
        public function findAll(int $limit = 10, int $offset = 0, array $filters = []): array
        {
            $whereClauses = [];
            $params = [];

            if (!empty($filters['type'])) {
                $whereClauses[] = "type = :type";
                $params['type'] = $filters['type'];
            }

            if (!empty($filters['user'])) {
                $whereClauses[] = "user_id = :user_id";
                $params['user_id'] = $filters['user'];
            }

            $whereSql = $whereClauses ? 'WHERE ' . join(' AND ', $whereClauses) : '';

            $query = $this->connection->prepare("
                SELECT * FROM Payment_Method $whereSql LIMIT :limit OFFSET :offset
            ");

            foreach ($params as $key => $value) {
                $query->bindValue(":$key", $value);
            }

            $query->bindValue(':limit', $limit, PDO::PARAM_INT);
            $query->bindValue(':offset', $offset, PDO::PARAM_INT);

            $query->execute();

            $paymentMethods = $query->fetchAll(PDO::FETCH_ASSOC);

            return array_map([$this, 'mapToPaymentMethod'], $paymentMethods);
        }

        /**
         * Crée un nouvel utilisateur.
         *
         * @throws \Exception
         */
        public function create(PaymentMethod|array $paymentMethod): PaymentMethod
        {
            $query = $this->connection->prepare("
                INSERT INTO Payment_Method (label, type, user_id, data, created_at, updated_at)
                VALUES (:label, :type, :user_id, :data, :created_at, :updated_at)
            ");

            $paymentMethod = is_array($paymentMethod) ? $paymentMethod : [
                'label'   => $paymentMethod->getLabel(),
                'type'    => $paymentMethod->getType(),
                'user_id' => $paymentMethod->getUser()->getId(),
                'data'    => $paymentMethod->getData(),
            ];

            $this->validatePaymentMethodData($paymentMethod);

            $paymentMethod['data'] = json_encode($paymentMethod['data']);
            $paymentMethod['created_at'] = (new DateTime())->format('Y-m-d H:i:s');
            $paymentMethod['updated_at'] = (new DateTime())->format('Y-m-d H:i:s');

            $query->execute($paymentMethod);
            $paymentMethod['id'] = $this->connection->lastInsertId();

            return $this->mapToPaymentMethod($paymentMethod);
        }

        /**
         * Met à jour un utilisateur existant.
         *
         * @throws \Exception
         */
        public function update(PaymentMethod|int $idOrPaymentMethod, ?array $data = null): bool
        {
            if (is_int($idOrPaymentMethod)) {
                $id = $idOrPaymentMethod;

                if ($data === null) {
                    throw new \Exception("Les données de la methode de paiement sont requises pour la mise à jour.");
                }
            } else {
                $id = $idOrPaymentMethod->getId();

                $data = [
                    'label'   => $idOrPaymentMethod->getLabel(),
                    'type'    => $idOrPaymentMethod->getType(),
                    'user_id' => $idOrPaymentMethod->getUser()->getId(),
                    'data'    => $idOrPaymentMethod->getData(),
                    ...($data !== null) ? $data : [],
                ];
            }

            $this->validatePaymentMethodData($data);

            $data['updated_at'] = (new DateTime())->format('Y-m-d H:i:s');

            $queryModifier = [];
            foreach (array_keys($data) as $key) {
                $queryModifier[$key] = $key . " = :" . $key;
            }

            $query = $this->connection->prepare(
                "UPDATE Payment_Method SET " . join(', ', $queryModifier) . " WHERE id = :id"
            );

            $query->execute([...$data, 'id' => $id]);

            return $query->rowCount() > 0;
        }

        /**
         * Supprime un utilisateur par son ID.
         *
         * @throws \Exception
         */
        public function delete(PaymentMethod|int $idOrPaymentMethod): bool
        {
            try {
                $query = $this->connection->prepare("DELETE FROM Payment_Method WHERE id = :id");
                $query->execute(['id' => is_int($idOrPaymentMethod) ? $idOrPaymentMethod : $idOrPaymentMethod->getId()]);

                return $query->rowCount() > 0;

            } catch (\PDOException $e) {
                throw new \Exception("Erreur lors de la suppression de la methode de paiement : " . $e->getMessage());
            }
        }

        /**
         * Map un tableau associatif en un objet PaymentMethod.
         *
         * @throws \Exception
         */
        private function mapToPaymentMethod(array $paymentMethod): PaymentMethod
        {
            $dataArray = json_decode($paymentMethod['data'], true);
            $paymentOptions = $this->paymentFactory->createPaymentOption($paymentMethod['type'], $dataArray);

            return new PaymentMethod(
                $paymentMethod['id'],
                $paymentMethod['label'],
                $paymentMethod['type'],
                $this->userManager->findById($paymentMethod['user_id']),
                $paymentOptions,
                new DateTime($paymentMethod['created_at']),
                new DateTime($paymentMethod['updated_at'])
            );
        }

        /**
         * @throws \App\Payment\Exception\InvalidPaymentMethodException
         */
        public function pay(PaymentMethod $paymentMethod, float $amount): void
        {
            $user = $paymentMethod->getUser();
            $type = $paymentMethod->getType();
            $options = $paymentMethod->getData();

            echo "## Paiement de $amount € par {$user->getFirstname()} {$user->getLastname()} avec la méthode $type<br/>";

            ($this->paymentFactory->createPaymentMethod($type))->pay($amount, $options);
        }


        /**
         * @throws \Exception
         */
        private function validatePaymentMethodData(array $data): void
        {
        }
    }
