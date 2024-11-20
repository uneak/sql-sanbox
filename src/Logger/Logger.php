<?php

    namespace App\Logger;

    class Logger
    {
        private static ?Logger $instance = null;
        private $logFile;

        private function __construct()
        {
            $this->logFile = fopen("app.log", "w");
        }

        public static function getInstance(): Logger
        {
            if (self::$instance === null) {
                self::$instance = new Logger();
            }
            return self::$instance;
        }

        public function log(string $message): void
        {
            $date = date("Y-m-d H:i:s");
            fwrite($this->logFile, "[$date] $message" . PHP_EOL);
        }


    }