<?php
class Connexion {
    private static $pdo;

    public static function getInstance() {
        if (!self::$pdo) {
            $host = 'localhost';
            $dbname = 'royer__m';
            $user = 'royer__m';
            $pass = 'hrWSHuUq';
            
            self::$pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$pdo;
    }
}
