<?php

    namespace App\Test;

    interface DeletableInterface
    {
        public function delete(): void;
        public function isDeleted(): bool;
        public function restore(): void;
    }