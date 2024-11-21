<?php

    namespace App\Models;

    use DateTime;

    class User
    {
        private int $id;
        private string $first_name;
        private string $last_name;
        private string|null $photo;
        private string $user_role; // ENUM('member', 'user', 'admin')
        private string|null $phone;
        private string $email;
        private string $password;
        private string $status; // ENUM('active', 'inactive')
        private ?DateTime $created_at;
        private ?DateTime $updated_at;

        public function __construct(
            int $id,
            string $first_name,
            string $last_name,
            string|null $photo,
            string $user_role,
            string|null $phone,
            string $email,
            string $password,
            string $status = 'active',
            ?DateTime $created_at = null,
            ?DateTime $updated_at = null
        ) {
            $this->id = $id;
            $this->first_name = $first_name;
            $this->last_name = $last_name;
            $this->photo = $photo;
            $this->user_role = $user_role;
            $this->phone = $phone;
            $this->email = $email;
            $this->password = $password;
            $this->status = $status;
            $this->created_at = $created_at ?? new DateTime();
            $this->updated_at = $updated_at ?? new DateTime();
        }

        public function getId(): int
        {
            return $this->id;
        }

        public function getFirstName(): string
        {
            return $this->first_name;
        }

        public function getLastName(): string
        {
            return $this->last_name;
        }

        public function getPhoto(): ?string
        {
            return $this->photo;
        }

        public function getUserRole(): string
        {
            return $this->user_role;
        }

        public function getPhone(): ?string
        {
            return $this->phone;
        }

        public function getEmail(): string
        {
            return $this->email;
        }

        public function getPassword(): string
        {
            return $this->password;
        }

        public function getStatus(): string
        {
            return $this->status;
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