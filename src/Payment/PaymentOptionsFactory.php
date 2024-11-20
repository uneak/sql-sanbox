<?php

    namespace App\Payment;

    use App\Payment\Exception\InvalidPaymentMethodException;
    use App\Payment\Options\BankTransfertOptions;
    use App\Payment\Options\BitcoinOptions;
    use App\Payment\Options\CreditCardOptions;
    use App\Payment\Options\PaymentOptionsInterface;
    use App\Payment\Options\PaypalOptions;

    readonly class PaymentOptionsFactory
    {
        private array $paymentOptions;

        public function __construct() {
            $this->paymentOptions = [
                'bank_transfer' => BankTransfertOptions::class,
                'paypal' => PaypalOptions::class,
                'bitcoin' => BitcoinOptions::class,
                'credit_card' => CreditCardOptions::class
            ];
        }

        public function getPaymentOptions(): array
        {
            return $this->paymentOptions;
        }

        /**
         * @throws \App\Payment\Exception\InvalidPaymentMethodException
         * @throws \ReflectionException
         */
        public function createPaymentOption(string $type, array $data): PaymentOptionsInterface
        {
            if (!isset($this->paymentOptions[$type])) {
                throw new InvalidPaymentMethodException("Options de paiement inconnue : $type");
            }

//            $reflection = new \ReflectionClass($this->paymentOptions[$type]);
//            $instance = $reflection->newInstance($data);

            $instance = new $this->paymentOptions[$type]($data);

            return $instance;
        }
    }