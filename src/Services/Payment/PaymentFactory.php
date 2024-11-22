<?php

    namespace App\Services\Payment;

    use App\Services\Payment\Exception\InvalidPaymentMethodException;
    use App\Services\Payment\Method\PaymentMethodInterface;
    use App\Services\Payment\Options\PaymentOptionsInterface;
    use App\Services\Payment\Type\BankTransferType;
    use App\Services\Payment\Type\BitcoinType;
    use App\Services\Payment\Type\CreditCardType;
    use App\Services\Payment\Type\PaymentTypeInterface;
    use App\Services\Payment\Type\PaypalType;

    class PaymentFactory
    {
        /**
         * @var array<string, \App\Services\Payment\Type\PaymentTypeInterface>
         */
        private array $paymentTypes;

        public function __construct()
        {
            $paymentTypes = [
                new PaypalType(),
                new BitcoinType(),
                new CreditCardType(),
                new BankTransferType()
            ];

            foreach ($paymentTypes as $paymentType) {
                $this->addPaymentType($paymentType);
            }
        }

        public function addPaymentType(PaymentTypeInterface $paymentType): void
        {
            $this->paymentTypes[$paymentType->getId()] = $paymentType;
        }

        public function getPaymentTypes(): array
        {
            return $this->paymentTypes;
        }

        public function getPaymentType(string $id): PaymentTypeInterface
        {
            return $this->paymentTypes[$id];
        }

        /**
         * @throws \App\Services\Payment\Exception\InvalidPaymentMethodException
         */
        public function createPaymentMethod(string $type): PaymentMethodInterface
        {
            if (!isset($this->paymentTypes[$type])) {
                throw new InvalidPaymentMethodException("Méthode de paiement inconnue : $type");
            }

            $methodClass = $this->paymentTypes[$type]->getMethod();

            //            $reflection = new \ReflectionClass($methodClass);
            //            return $reflection->newInstance();

            return new $methodClass();
        }

        /**
         * @throws \App\Services\Payment\Exception\InvalidPaymentMethodException
         */
        public function createPaymentOption(string $type, array $data): PaymentOptionsInterface
        {
            if (!isset($this->paymentTypes[$type])) {
                throw new InvalidPaymentMethodException("Options de paiement inconnue : $type");
            }

            $optionsClass = $this->paymentTypes[$type]->getOptions();

            //            $reflection = new \ReflectionClass($optionsClass);
            //            return $reflection->newInstance($data);

            return new $optionsClass($data);
        }
    }