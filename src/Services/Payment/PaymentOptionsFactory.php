<?php

    namespace App\Services\Payment;

    use App\Services\Payment\Exception\InvalidPaymentMethodException;
    use App\Services\Payment\Options\BankTransfertOptions;
    use App\Services\Payment\Options\BitcoinOptions;
    use App\Services\Payment\Options\CreditCardOptions;
    use App\Services\Payment\Options\PaymentOptionsInterface;
    use App\Services\Payment\Options\PaypalOptions;

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
         * @throws \App\Services\Payment\Exception\InvalidPaymentMethodException
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