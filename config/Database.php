<?php

class Database
{
    private static $pdo = null;

    // 🔧 CHANGE THESE VALUES
    private static $host = "localhost";
    private static $dbName = "library_db";   // 👈 YOUR DATABASE NAME
    private static $username = "root";   // 👈 DB USER
    private static $password = "alilah396";       // 👈 DB PASSWORD

    public static function connect()
    {
        if (self::$pdo === null) {
            self::$pdo = new PDO(
                "mysql:host=" . self::$host . ";dbname=" . self::$dbName . ";charset=utf8",
                self::$username,
                self::$password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
                ]
            );
        }

        return self::$pdo;
    }
}

