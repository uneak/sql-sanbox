<?php

    namespace App\Reservation;

    use DateTime;

    class Reservation
    {
        private int $id;
        private Room $room;
        private User $user;
        private DateTime $start_at;
        private DateTime $end_at;
        private string $status; //ENUM('pending', 'confirmed', 'cancelled')
        private DateTime $created_at;
        private DateTime $updated_at;


        public function __construct(
            int $id,
            Room $room,
            User $user,
            DateTime $start_at,
            DateTime $end_at,
            string $status = 'pending',
            DateTime $created_at = null,
            DateTime $updated_at = null
        ) {
            $this->id = $id;
            $this->room = $room;
            $this->user = $user;
            $this->start_at = $start_at;
            $this->end_at = $end_at;
            $this->status = $status;
            $this->created_at = $created_at ?? new DateTime();
            $this->updated_at = $updated_at ?? new DateTime();
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function getRoom(): Room
        {
            return $this->room;
        }

        public function getUser(): User
        {
            return $this->user;
        }

        public function getStartAt(): DateTime
        {
            return $this->start_at;
        }

        public function getEndAt(): DateTime
        {
            return $this->end_at;
        }

        public function getStatus(): string
        {
            return $this->status;
        }

        public function setStatus(string $status): void
        {
            $this->status = $status;
        }

        public function getCreatedAt(): DateTime
        {
            return $this->created_at;
        }

        public function getUpdatedAt(): DateTime
        {
            return $this->updated_at;
        }
    }