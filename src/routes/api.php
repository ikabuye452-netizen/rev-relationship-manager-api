<?php

require_once __DIR__ . '/../controllers/UsersController.php';

$usersController = new UsersController();

$requestUri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$requestMethod = $_SERVER['REQUEST_METHOD'];


if ($requestUri == "/") {
    switch ($requestMethod) {
        case "GET":
            echo "You are in the root page!";
            break;
        default:
            sendResponse405() ;
            break;
    }
} elseif ($requestUri == "/users") {
    switch ($requestMethod) {
        case "GET":
            $usersController->getAllUser();
            break;
        default:
            sendResponse405();
            break;
    }
} elseif (preg_match('#^/users/(\d+)$#', $requestUri, $matches)) {
    $userId = $matches[1];
    switch ($requestMethod) {
        case "GET":
            $usersController->getUserById($userId);
            break;
        default:
            sendResponse405();
            break;
    }
} else {
    http_response_code(404);
    echo "Error 404! No route found!";
}


function sendResponse405() {
    http_response_code(405);
    echo json_encode(["message" => "Method Not Allowed"]);
}