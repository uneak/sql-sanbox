<?php

    namespace App\Payment\Method;

    use App\Payment\Options\PaymentOptionsInterface;

    interface PaymentMethodInterface
    {
        public function getName(): string;
        public function pay(float $amount, ?PaymentOptionsInterface $options = null): void;
    }