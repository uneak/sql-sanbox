<?php

    namespace App\Models;

    use App\Payment\Options\PaymentOptionsInterface;
    use DateTime;

    class PaymentMethod
    {
        private int $id;
        private User $user;
        private string $label;
        private string $type;
        private PaymentOptionsInterface $data;
        private ?DateTime $created_at;
        private ?DateTime $updated_at;

        public function __construct(
            int $id,
            string $label,
            string $type,
            User $user,
            PaymentOptionsInterface $data,
            ?DateTime $created_at = null,
            ?DateTime $updated_at = null
        ) {
            $this->id = $id;
            $this->label = $label;
            $this->type = $type;
            $this->user = $user;
            $this->data = $data;
            $this->created_at = $created_at ?? new DateTime();
            $this->updated_at = $updated_at ?? new DateTime();
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function getUser(): User
        {
            return $this->user;
        }

        public function getLabel(): string
        {
            return $this->label;
        }

        public function getType(): string
        {
            return $this->type;
        }

        public function getData(): PaymentOptionsInterface
        {
            return $this->data;
        }

        public function getCreatedAt(): ?DateTime
        {
            return $this->created_at;
        }

        public function getUpdatedAt(): ?DateTime
        {
            return $this->updated_at;
        }
    }