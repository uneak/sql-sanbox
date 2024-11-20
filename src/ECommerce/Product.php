<?php

    namespace App\ECommerce;

    use App\ECommerce\Exception\InvalidProductException;

    class Product
    {

        public function __construct(
            private readonly string $name,
            private int $stock,
            private readonly float $price,
        )
        {
        }

        public function isAvailable(): bool
        {
            return ($this->stock > 0);


        }

        /**
         * @throws InvalidProductException
         */
        public function purchase(): void
        {
            if (!$this->isAvailable()) {
                throw new InvalidProductException(
                    sprintf('Product %s is not available', $this->name),
                );
            }

            $this->stock--;
        }

        public function getPrice(): float
        {
            return $this->price;
        }

        public function getName(): string
        {
            return $this->name;
        }

    }