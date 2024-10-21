<?php

$requestUri = $_SERVER['REQUEST_URI'];
$requestMethod = $_SERVER['REQUEST_METHOD'];

if ($requestUri == "/" && $requestMethod == "GET") {
    echo "You are in the root page!";
} else {
    http_response_code(404);
    echo "Error 404! No route found!";
}
