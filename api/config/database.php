<?php

require_once 'config.php';

// Singleton to connect db
class Database {
    private static $instance = null;
    private $conn;

    private function __construct()
    {
        $this->conn = new PDO(
            "mysql:host=" . DB_HOSTNAME . ";
            dbname=" . DB_DATABASE,
            DB_USERNAME,
            DB_PASSWORD,
            array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'")
        );
    }

    public static function getInstance()
    {
        if(!self::$instance)
        {
            self::$instance = new Database();
        }

        return self::$instance;
    }

    public function getConnection()
    {
        return $this->conn;
    }
}