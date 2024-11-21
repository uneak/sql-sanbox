<?php

    namespace App\Payment\Type;


    interface PaymentTypeInterface
    {
        public function getId(): string;
        public function getName(): string;
        /**
         * @return class-string<\App\Payment\Method\PaymentMethodInterface>
         */
        public function getMethod(): string;
        /**
         * @return class-string<\App\Payment\Options\PaymentOptionsInterface>
         */
        public function getOptions(): string;
    }