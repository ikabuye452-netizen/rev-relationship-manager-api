<?php

require '../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__  . '/../');
$dotenv->load();


class Database {
    private $DB_HOST;
    private $DB_USER;
    private $DB_PASS;
    private $DB_NAME;
    public $conn = null;

    public function __construct() {
        $this->DB_HOST = $_ENV['DB_HOST'];
        $this->DB_USER = $_ENV['DB_USER'];
        $this->DB_PASS = $_ENV['DB_PASS'];
        $this->DB_NAME = $_ENV['DB_NAME'];
    }

    public function connect() {
        try {
            $dsn = "mysql:host" . $this->DB_HOST . ";db_name" . $this->DB_NAME . ";charset=utf8";
            $pdo = new PDO($dsn, $this->DB_USER, $this->DB_PASS);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
        }
    }
}