<?php

    namespace App\Services\Payment\Options;

    readonly class BitcoinOptions implements PaymentOptionsInterface
    {
        private string $address;

        public function __construct(array $data) {
            $this->address = $data['address'];
        }

        public function getAddress(): string
        {
            return $this->address;
        }

        public function getName(): string
        {
            return "Bitcoin";
        }

        public function _toArray(): array
        {
            return [
                'address' => $this->address
            ];
        }
    }