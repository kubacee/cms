<?php

class Database{
    private function getConfig() {
        $data = parse_ini_file(SYSTEM .'config/config.ini');

        return $data;
    }

    public static function connect() {
        $config = self::getConfig();

        $pdo = new PDO(
            'mysql:host=localhost;
             dbname='.$config['database'].';',
            $config['user'],
            $config['password']
        );

        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $pdo->exec("SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");

        return $pdo;
    }
}