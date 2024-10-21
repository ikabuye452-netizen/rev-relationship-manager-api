<?php

require_once __DIR__ . '/../../config/database.php';

class User {
    private $conn;

    public function __construct() {
        $this->conn = (new Database())->connect();
    }

    public function getAllUser() : array {
        if ($this->conn) {
            $query = "SELECT * FROM user";
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }

    public function getUserById($id) : array {
        if ($this->conn) {
            $query = "SELECT * FROM user WHERE id=" . $id;
            $stmt = $this->conn->query($query);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return [];
        }
    }
}