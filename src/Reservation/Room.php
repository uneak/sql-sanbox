<?php

    namespace App\Reservation;

    use DateTime;

    class Room
    {
        private int $id;
        private string $name;
        private int $capacity;
        private float $width;
        private float $length;
        private string $status;
        private string|null $description;
        private string|null $photo;
        private ?DateTime $createdAt;
        private ?DateTime $updatedAt;

        public function __construct(
            int $id,
            string $name,
            int $capacity,
            float $width,
            float $length,
            string $status = 'active',
            string|null $description = null,
            string|null $photo = null,
            ?DateTime $createdAt = null,
            ?DateTime $updatedAt = null
        ) {
            $this->id = $id;
            $this->name = $name;
            $this->capacity = $capacity;
            $this->width = $width;
            $this->length = $length;
            $this->status = $status;
            $this->description = $description;
            $this->photo = $photo;
            $this->createdAt = $createdAt ?? new DateTime();
            $this->updatedAt = $updatedAt ?? new DateTime();
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function getName(): string
        {
            return $this->name;
        }

        public function getCapacity(): int
        {
            return $this->capacity;
        }

        public function getWidth(): float
        {
            return $this->width;
        }

        public function getLength(): float
        {
            return $this->length;
        }

        public function getArea(): float
        {
            return $this->getLength() * $this->getWidth();
        }

        public function getDescription(): string|null
        {
            return $this->description;
        }

        public function getPhoto(): string|null
        {
            return $this->photo;
        }

        public function getCreatedAt(): ?DateTime
        {
            return $this->createdAt;
        }

        public function getUpdatedAt(): ?DateTime
        {
            return $this->updatedAt;
        }


        public function isActive(): bool
        {
            return $this->status === 'active';
        }

        public function activate(): void
        {
            $this->status = 'active';
        }

        public function inactivate(): void
        {
            $this->status = 'inactive';
        }

    }