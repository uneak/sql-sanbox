<?php

    namespace App\Services\Payment;

    use App\Services\Payment\Exception\InvalidPaymentMethodException;
    use App\Services\Payment\Method\BankTransferPayment;
    use App\Services\Payment\Method\BitcoinPayment;
    use App\Services\Payment\Method\CreditCardPayment;
    use App\Services\Payment\Method\PaymentMethodInterface;
    use App\Services\Payment\Method\PayPalPayment;

    readonly class PaymentMethodFactory
    {
        private array $paymentMethods;

        public function __construct() {
            $this->paymentMethods = [
                'bank_transfer' => BankTransferPayment::class,
                'paypal' => PayPalPayment::class,
                'bitcoin' => BitcoinPayment::class,
                'credit_card' => CreditCardPayment::class
            ];
        }

        public function getPaymentMethods(): array
        {
            return $this->paymentMethods;
        }

        /**
         * @throws \App\Services\Payment\Exception\InvalidPaymentMethodException
         */
        public function getPaymentMethod(string $type): PaymentMethodInterface
        {
            if (!isset($this->paymentMethods[$type])) {
                throw new InvalidPaymentMethodException("Méthode de paiement inconnue : $type");
            }

            return new $this->paymentMethods[$type]();
        }
    }