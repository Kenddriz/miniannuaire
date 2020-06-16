<?php
require "connexion.php";

    class App {

        private static $database;

         public static function getDb() {
            if(is_null(self::$database)) {
                $params = require dirname(__DIR__).'/config/database.php';
                self::$database = new Connexion($params['user'], $params['password'], $params['db'], $params['host']);
            }
            return (self::$database)->getPdo();
            
         }
    }
?>