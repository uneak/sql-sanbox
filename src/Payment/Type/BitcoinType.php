<?php

    namespace App\Payment\Type;

    use App\Payment\Method\BitcoinPayment;
    use App\Payment\Options\BitcoinOptions;

    class BitcoinType implements PaymentTypeInterface
    {
        public function getId(): string
        {
            return "bitcoin";
        }

        public function getName(): string
        {
            return "Bitcoin";
        }

        /**
         * @return class-string<\App\Payment\Method\PaymentMethodInterface>
         */
        public function getMethod(): string {
            return BitcoinPayment::class;
        }

        /**
         * @return class-string<\App\Payment\Options\PaymentOptionsInterface>
         */
        public function getOptions(): string {
            return BitcoinOptions::class;
        }
    }