<?php

require_once __DIR__ . '/../models/User.php';

class UsersController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function getAllUser() {
        try {
            $result = $this->user->getAllUser();
    
            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                "status"=>"success",
                "message"=> "successfully get all user data from database",
                "data"=> $result
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                "status"=> "error",
                "message"=> "server error occured"
            ]);
        }
    }

    public function getUserById($id) {
        try {
            $result = $this->user->getUserById($id);
    
            $message = empty($result) ? "User not found" : "Successfully retrieved user data";

            header('Content-Type: application/json');
            http_response_code(empty($result) ? 404 : 200);
            echo json_encode([
                "status"=>"success",
                "message"=> $message,
                "data"=> $result
            ]);
        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                "status"=> "error",
                "message"=> "server error occured"
            ]);
        }
    }
}
