<?php

require_once __DIR__ . '/../models/User.php';

class UsersController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function getAllUser() : void {
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

    public function getUserById($id) : void {
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

    public function addNewUser() : void {
        try {
            $name = $_POST['name'];
            $age = $_POST['age'];
            $job = $_POST['job'];

            $this->user->addNewUser($name, $age, $job);

            $result = $this->user->getUserByName($name);
            if (empty($result)) {
                $message = "Adding new user data failed";
            } else {
                $message = "Successfully add new user data";
            }

            header('Content-Type: application/json');
            http_response_code(empty($result) ? 400 : 201);
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

    public function editUserData($userId) : void {
        try {
            if (empty($this->user->getUserById($userId))) {
                http_response_code(404);
                echo json_encode([
                    "status"=> "success",
                    "message"=> "user not found"
                ]);
                exit;
            }


            $inputData = json_decode(file_get_contents('php://input'), true);

            if ($inputData === null) {
                http_response_code(400);
                echo json_encode([
                    "status" => "error",
                    "message"=> "data input is empty"
                ]);
                exit;
            }

            if (!isset($inputData['name']) && !isset($inputData['age']) && !isset($inputData['job'])) {
                http_response_code(422);
                echo json_encode([
                    "status" => "error",
                    "message"=> "required data missing"
                ]);
                exit;
            }

            if (isset($inputData["name"])) {
                $this->user->editUserName($userId,$inputData["name"]);
            }

            if (isset($inputData["age"])) {
                $this->user->editUserAge($userId, $inputData["age"]);
            }

            if (isset($inputData["job"])) {
                $this->user->editUserAge($userId, $inputData["job"]);
            }

            $result = $this->user->getUserById($userId);

            header('Content-Type: application/json');
            http_response_code(200);
            echo json_encode([
                "status"=>"success",
                "message"=> "successfully update data",
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
