<?php
namespace App\Core;

use PDO;
use Exception;

class Database {
    private static $instances = [];

    public static function connection($name = null) {
        $config = require __DIR__ . "/../../config/database.php";
        $name = $name ?: $config["default"];

        if (!isset(self::$instances[$name])) {
            $dbConfig = $config["connections"][$name];

            try {
                $dsn = "mysql:host={$dbConfig["host"]};dbname={$dbConfig["database"]};charset={$dbConfig["charset"]}";
                self::$instances[$name] = new PDO($dsn, $dbConfig["username"], $dbConfig["password"]);
                self::$instances[$name]->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (Exception $e) {
                throw new Exception("Failed to connect to the database: " . $e->getMessage());
            }
        }

        return self::$instances[$name];
    }
}
