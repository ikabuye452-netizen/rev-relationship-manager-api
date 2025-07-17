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
            return null;
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
            return null;
        }
    }

    public function getUserByName($name) : ?array {
        try {
            $query = "SELECT * FROM user WHERE name=:name";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
            return null;
        }
    }

    public function addNewUser($name, $age, $job) : void {
        try {
            $query = "INSERT INTO user (name, age, job) VALUES (:name, :age, :job)";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(":name", $name, PDO::PARAM_STR);
            $stmt->bindParam(":age", $age, PDO::PARAM_STR);
            $stmt->bindParam(":job", $job, PDO::PARAM_STR);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }

    public function editUserName($id, $newName) : void {
        try {
            $query = "UPDATE user SET name = ? WHERE id = ?";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $newName, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }

    public function editUserAge($id, $newAge) : void {
        try {
            $query = "UPDATE user SET age = ? WHERE id = ?";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $newAge, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }

    public function editUserJob($id, $newJob) : void {
        try {
            $query = "UPDATE user SET job = ? WHERE id = ?";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $newJob, PDO::PARAM_STR);
            $stmt->bindParam(2, $id, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }

    public function deleteUserById($userId) : void {
        try {
            $query = "DELETE FROM user WHERE id = ?";

            if ($this->conn === null) {
                throw new Exception("Database connection is null.");
            }

            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $userId, PDO::PARAM_INT);
            $stmt->execute();
        } catch (PDOException $e) {
            error_log("Query failed: " . $e->getMessage(), 3, '../../logs/error.log');
        }
    }
}
