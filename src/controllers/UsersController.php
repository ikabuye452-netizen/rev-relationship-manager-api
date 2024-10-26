<?php

require_once __DIR__ . '/../models/User.php';

class UsersController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function getAllUser() {
        $result = $this->user->getAllUser();

        http_response_code(200);
        header('Content-Type: application/json');
        $response = [
            "status"=>"success",
            "message"=> "successfully get all user data from database",
            "data"=> $result
        ];
        echo json_encode($response);
    }

    public function getUserById($id) {
        $result = $this->user->getUserById($id);

        header('Content-Type: application/json');
        
        if (empty($result)) {
            http_response_code(404);
            $message = "user not found";
        } else {
            http_response_code(200);
            $message = "successfully get user data from database";
        }

        $response = [
            "status"=>"success",
            "message"=> $message,
            "data"=> $result
        ];
        echo json_encode($response);
    }
}
