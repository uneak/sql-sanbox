<?php

    namespace App\Doc;

    class Report extends Document
    {
        public function generate(): string
        {
            return "header\n" . $this->content . "\nfooter";
        }

        public function prepare(): void
        {
            //            $this->content = "page de garde\n" . $this->generate();
            echo "Préparation spécifique du rapport terminée.\n";
        }
    }