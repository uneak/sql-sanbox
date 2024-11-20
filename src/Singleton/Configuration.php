<?php

    namespace App\Singleton;

    class Configuration
    {
        private static Configuration $instance;
        private array $settings;

        public function __construct() {
            $this->settings = parse_ini_file("../configuration/config.ini", true);
        }

        public static function getInstance(): Configuration
        {
            if (!isset(Configuration::$instance)) {
                Configuration::$instance = new Configuration();
            }
            return Configuration::$instance;
        }

        public function get(string $key): ?string
        {
            // Découper la clé en sous-clés pour accéder aux niveaux du tableau
            $keys = explode('.', $key);
            $value = $this->settings;

            foreach ($keys as $k) {
                if (isset($value[$k])) {
                    $value = $value[$k];
                } else {
                    return null; // Retourne null si la clé n'existe pas
                }
            }

            return is_string($value) ? $value : null;
        }

    }