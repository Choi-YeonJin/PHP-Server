<?php

use Controllers\UserController;

include_once ("../../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uriArray = explode("/", $uri);

$userController = new UserController();

switch ($method . ":" . $uriArray[1]) {
    case "GET:user":
        $userController->select($uriArray);
        break;
    case "POST:user":
        $userController->create(file_get_contents('php://input'));
        break;
    case "POST:login":
        $userController->login(file_get_contents('php://input'));
    default:
        break;
}
?>