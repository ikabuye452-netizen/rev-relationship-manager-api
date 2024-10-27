<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;

    public function __construct() {
        try {
            $this->conn = (new Database())->connect();
        } catch (Exception $e) {
            $this->conn = null;
            error_log("[" . date("Y-m-d H:i:s") . "] Connection failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }

    public function getAllUser() : ?array {
        try {
            $query = "SELECT * FROM user";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }

    public function getUserById($id) : ?array {
        try {
            $query = "SELECT * FROM user WHERE id=:id";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }
}