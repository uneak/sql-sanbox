<?php

    namespace App\Payment;

    use App\Reservation\User;

    readonly class Payment
    {
        public function __construct(
            private PaymentMethodFactory $paymentMethodFactory,
            private UserPaymentOptionsFactory $userPaymentOptionsManager
        ) { }

        /**
         * @throws \App\Payment\Exception\InvalidPaymentOptionsException
         * @throws \App\Payment\Exception\InvalidPaymentMethodException
         * @throws \App\Payment\Exception\InvalidPaymentUserException
         */
        public function pay(User $user, string $type, float $amount): void
        {
            echo "## Paiement de $amount € par {$user->getFirstname()} {$user->getLastname()} avec la méthode $type<br/>";

            $paymentMethod = $this->paymentMethodFactory->getPaymentMethod($type);
            $paymentOptions = $this->userPaymentOptionsManager->getPaymentOptions($user, $type);

            $paymentMethod->pay($amount, $paymentOptions);
        }
    }