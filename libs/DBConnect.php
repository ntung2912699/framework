<?php
namespace libs;
use App\Config\DBConfig;
use PDO;

class DBConnect
{

    protected static function getConnect()
    {
        static $db = null;

        if ($db === null) {
            $dsn = 'mysql:host=' . DBConfig::DB_HOST . ';dbname=' . DBConfig::DB_NAME . ';charset=utf8';
            $db = new PDO($dsn, DBConfig::DB_USER, DBConfig::DB_PASSWORD);

            // Throw an Exception when an error occurs
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        return $db;
    }

}