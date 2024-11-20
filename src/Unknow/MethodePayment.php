<?php

    namespace App\Unknow;

    use App\Unknow\VirementBancaire;
    use App\Unknow\CarteBancaire;
    use App\Unknow\Paypal;

    class MethodePayment
    {
        /**
         * @var array<\App\Unknow\interfaces\InterfacePaiement>
         */
        private array $methodes = [];

        public function __construct(array $methodes) {
            $this->methodes = $methodes;
        }

        public function choixPayment(float $amount, string $methodes): void
        {
            if (!isset($this->methodes[$methodes])) {
                throw new \Exception("La méthode de paiement n'existe pas");
            }

            $method = $this->methodes[$methodes];
            $method->processPayment($amount);
        }


    }
