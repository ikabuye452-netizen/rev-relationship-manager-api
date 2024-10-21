<?php

require_once __DIR__ . '/../models/User.php';

class UsersController {
    private $user;

    public function __construct() {
        $this->user = new User();
    }

    public function getAllUser() {
        $result = $this->user->getAllUser();

        header('Content-Type: application/json');
        echo json_encode($result);
    }

    public function getUserById($id) {
        $result = $this->user->getUserById($id);

        header('Content-Type: application/json');
        echo json_encode($result);
    }
}
