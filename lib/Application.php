<?php

    class Application {
        
        public static $conf;
        public static $params;

        public static function run() {
            self::setConf();
            self::setParams();

            Users::runAPI(self::$params);
        }

        private static function setConf() {
            require 'conf.php';

            self::$conf = $conf;
        }

        private static function setParams() {
            self::$params = explode('/', $_SERVER['REQUEST_URI']);

            array_shift(self::$params);
        }
    }
