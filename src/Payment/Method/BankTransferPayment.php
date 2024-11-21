<?php

    namespace App\Payment\Method;

    use App\Payment\Exception\InvalidPaymentOptionsException;
    use App\Payment\Options\BankTransfertOptions;
    use App\Payment\Options\PaymentOptionsInterface;
    use InvalidArgumentException;

    class BankTransferPayment implements PaymentMethodInterface
    {
        /**
         * @throws \App\Payment\Exception\InvalidPaymentOptionsException
         */
        public function pay(float $amount, ?PaymentOptionsInterface $options = null): void
        {
            if (!$options instanceof BankTransfertOptions) {
                throw new InvalidPaymentOptionsException("Les options de paiement ne sont pas valides pour ce mode de paiement.");
            }

            if (!$options->getIban()) {
                throw new InvalidArgumentException("IBAN requis pour le virement bancaire.");
            }

            echo sprintf(
                "Paiement de %s € par Virement Bancaire vers l'IBAN %s.<br/><br/>",
                $amount,
                $options->getIban()
            );
        }

    }