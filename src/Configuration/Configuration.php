<?php

    namespace App\Configuration;

    class Configuration
    {
        public array $settings;
        public static ?Configuration $instance = null;

        private function __construct() {
            $this->settings = parse_ini_file("../configuration/config.ini", true);
        }

        public static function getInstance(): Configuration
        {
            if (Configuration::$instance === null) {
                $config = new Configuration();
                Configuration::$instance = $config;
            }
            return Configuration::$instance;
        }
    }