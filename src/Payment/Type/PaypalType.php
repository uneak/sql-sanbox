<?php

    namespace App\Payment\Type;

    use App\Payment\Method\PayPalPayment;
    use App\Payment\Options\PaypalOptions;

    class PaypalType implements PaymentTypeInterface
    {
        public function getId(): string
        {
            return "paypal";
        }

        public function getName(): string
        {
            return "Paypal";
        }

        /**
         * @return class-string<\App\Payment\Method\PaymentMethodInterface>
         */
        public function getMethod(): string {
            return PayPalPayment::class;
        }

        /**
         * @return class-string<\App\Payment\Options\PaymentOptionsInterface>
         */
        public function getOptions(): string {
            return PaypalOptions::class;
        }
    }