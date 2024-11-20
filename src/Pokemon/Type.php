<?php

    namespace App\Pokemon;

    abstract readonly class Type
    {
        private string $name;

        public function __construct(string $name) {
            $this->name = $name;
        }

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }
    }