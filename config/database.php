<?php

class Database
{
    private static $instance = null;
    private $conn;

    private $host = "127.0.0.1";
    private $port = "3307";
    private $db_name = "minievent";
    private $username = "root";
    private $password = "";
    private $charset = "utf8mb4";

    private function __construct()
    {
        try {
            $dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->db_name};charset={$this->charset}";

            $options = [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ];

            $this->conn = new PDO($dsn, $this->username, $this->password, $options);

        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }

    public static function getInstance()
    {
        if (self::$instance === null) {
            self::$instance = new Database();
        }
        return self::$instance->conn;
    }
}

// Constantes globales
define('BASE_URL', 'http://localhost:8000/');
define('SITE_NAME', 'MiniEvent');