<?php

class Database {
    private $db_file;
    public $conn;

    public function __construct($db_file) {
        $this->db_file = $db_file;
    }

    public function getConnection(): ?PDO {
        $this->conn = null;

        try {
            $dsn = "sqlite:" . $this->db_file;
            $this->conn = new PDO($dsn);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            error_log("[" . date("Y-m-d H:i:s") . "] Connection failed: " . $e->getMessage() . "\r\n", 3, '../logs/error.log');
        }

        return $this->conn;
    }
}

