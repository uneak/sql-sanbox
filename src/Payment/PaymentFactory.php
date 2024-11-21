<?php

    namespace App\Payment;

    use App\Payment\Exception\InvalidPaymentMethodException;
    use App\Payment\Method\PaymentMethodInterface;
    use App\Payment\Options\PaymentOptionsInterface;
    use App\Payment\Type\BankTransferType;
    use App\Payment\Type\BitcoinType;
    use App\Payment\Type\CreditCardType;
    use App\Payment\Type\PaymentTypeInterface;
    use App\Payment\Type\PaypalType;

    class PaymentFactory
    {
        /**
         * @var array<string, \App\Payment\Type\PaymentTypeInterface>
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
         * @throws \App\Payment\Exception\InvalidPaymentMethodException
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
         * @throws \App\Payment\Exception\InvalidPaymentMethodException
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