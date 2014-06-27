<?php

/**
 * Connection to the database
 * admin url: https://p3nlmysqladm001.secureserver.net/nld50/33
 * htmlspecialchars()
 * @author Ben Mo
 */
class Database {
    private static $user = 'phpclass506';
    private static $pass = 'H3lpP@ssword';
    private static $dsn = "mysql:host=phpclass506.db.12071129.hostedresource.com;dbname=phpclass506";
    private static $db;
    public static function getDB()
    {
        if (!isset(self::$db)) {
            try {
                self::$db = new PDO(self::$dsn, self::$user, self::$pass);
            } catch (PDOException $ex) {
                echo "Error occured : " . $ex->getMessage();
            }
        }
        return self::$db;
    }
}
