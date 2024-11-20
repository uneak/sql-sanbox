<?php

    namespace App\Payment\Options;

    interface PaymentOptionsInterface
    {
        public function __construct(array $data);
        public function getName(): string;
        public function _toArray(): array;
    }