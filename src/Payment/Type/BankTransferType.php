<?php

    namespace App\Payment\Type;

    use App\Payment\Method\BankTransferPayment;
    use App\Payment\Options\BankTransfertOptions;

    class BankTransferType implements PaymentTypeInterface
    {
        public function getId(): string
        {
            return "bank_transfer";
        }

        public function getName(): string
        {
            return "Virement bancaire";
        }

        /**
         * @return class-string<\App\Payment\Method\PaymentMethodInterface>
         */
        public function getMethod(): string {
            return BankTransferPayment::class;
        }

        /**
         * @return class-string<\App\Payment\Options\PaymentOptionsInterface>
         */
        public function getOptions(): string {
            return BankTransfertOptions::class;
        }
    }