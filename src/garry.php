<?php

    class SystemPayment
    {

        public string $processPayment;
        public datetime $datePayment;

        public function construct($processPayment, $date)
        {
            $this->processPayment = $processPayment;
            $this->datePayment = $date;
        }

        public function amountPayment(float $amount)
        {

        }

        public function processPayment(): bool
        {
            switch ($this->processPayment) {
                case "Carte Bancaire":
                    return true;

                case "paypal":
                    return true;

                case "Virement bancaire":
                    return true;
            }
        }

        public function setPublicationDate(DateTime $date)
        {
            $this->datePayment = $date;

            return $date;
        }
    }


    class CarteBancaire extends SystemPayment
    {
        public int $numeroCarte;
        public int $ccv;

        public function construct($processPayment = "Carte Bancaire", $numeroCarte, $ccv, $date)
        {
            $this->processPayment = $processPayment;
            $this->numeroCarte = $numeroCarte;
            $this->ccv = $ccv;
            $this->datePayment = $date;


        }
    }


    class paypal extends SystemPayment
    {
        public string $email;

        public function construct($processPayment = "Paypal", $email, $date)
        {
            $this->processPayment = $processPayment;
            $this->datePayment = $date;
            $this->$email = $email;


        }
    }

    class virementBancaire extends SystemPayment
    {
        public int $rib;

        public function construct($processPayment = "Virement bancaire", $rib, $date)
        {
            $this->processPayment = $processPayment;
            $this->$rib = $rib;
            $this->datePayment = $date;


        }
    }