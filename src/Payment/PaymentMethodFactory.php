<?php

    namespace App\Payment;

    use App\Payment\Exception\InvalidPaymentMethodException;
    use App\Payment\Method\BankTransferPayment;
    use App\Payment\Method\BitcoinPayment;
    use App\Payment\Method\CreditCardPayment;
    use App\Payment\Method\PaymentMethodInterface;
    use App\Payment\Method\PayPalPayment;
    use App\Payment\Options\BankTransfertOptions;
    use App\Payment\Options\BitcoinOptions;
    use App\Payment\Options\CreditCardOptions;
    use App\Payment\Options\PaypalOptions;

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
         * @throws \App\Payment\Exception\InvalidPaymentMethodException
         */
        public function getPaymentMethod(string $type): PaymentMethodInterface
        {
            if (!isset($this->paymentMethods[$type])) {
                throw new InvalidPaymentMethodException("Méthode de paiement inconnue : $type");
            }

            return new $this->paymentMethods[$type]();
        }
    }