<?php

    namespace App\Error\Exception;

    class StringParameterException extends \Exception
    {
        private string $stringError;

        public function __construct(string $message, string $stringError)
        {
            parent::__construct($message);
            $this->stringError = $stringError;
        }

        public function getStringError(): string
        {
            return $this->stringError;
        }
    }