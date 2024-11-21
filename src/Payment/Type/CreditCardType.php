<?php

    namespace App\Payment\Type;

    use App\Payment\Method\CreditCardPayment;
    use App\Payment\Options\CreditCardOptions;

    class CreditCardType implements PaymentTypeInterface
    {
        public function getId(): string
        {
            return "credit_card";
        }

        public function getName(): string
        {
            return "Credit Card";
        }

        /**
         * @return class-string<\App\Payment\Method\PaymentMethodInterface>
         */
        public function getMethod(): string {
            return CreditCardPayment::class;
        }

        /**
         * @return class-string<\App\Payment\Options\PaymentOptionsInterface>
         */
        public function getOptions(): string {
            return CreditCardOptions::class;
        }
    }