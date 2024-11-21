<?php

    namespace App\Services\Payment\Method;

    use App\Services\Payment\Options\PaymentOptionsInterface;

    interface PaymentMethodInterface
    {
        public function getName(): string;
        public function pay(float $amount, ?PaymentOptionsInterface $options = null): void;
    }