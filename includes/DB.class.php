<?php
class DB {
    static function getDB () {
        try {
            $dsn = "mysql:host=".DB_HOST.";dbname=".DB_NAME;
            $username = DB_USER;
            $passwd = DB_PASS;
            $pdo = new PDO($dsn, $username, $passwd);
            $pdo->query("SET NAMES UTF8");
            return $pdo;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}