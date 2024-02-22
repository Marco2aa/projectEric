<?php

class DB
{
    private static $host = 'db';
    private static $dbName = 'pizzeriadb';
    private static $user = 'pizzeriadb';
    private static $password = 'pizzeriadb';
    private static $connection = null;

    public static function getConnection() {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO('mysql:host=' . self::$host . ';dbname=' . self::$dbName, self::$user, self::$password);
            } catch (PDOException $e) {
                die("Erreur de connexion à la base de données : " . $e->getMessage());
            }
        }
        return self::$connection;
    }
}
