<?php

    namespace App\ECommerce;

    use App\ECommerce\Exception\PaymentDeclinedException;

    class PaymentSystem
    {

        private float $maxAmount;

        public function __construct(float $maxAmount = 1000) {
            $this->maxAmount = $maxAmount;
        }

        /**
         * @throws \App\ECommerce\Exception\PaymentDeclinedException
         */
        public function processPayment(Product $product) : void
        {
            if ($product->getPrice() > $this->maxAmount) {
                throw new PaymentDeclinedException(
                    sprintf( 'Payment declined: %s amount %f exceeds %f', $product->getName(), $product->getPrice(), $this->maxAmount),
                );
            }
        }
    }