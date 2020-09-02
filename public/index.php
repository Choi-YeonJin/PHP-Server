<?php

use Controllers\UserController;
use Controllers\ContractController;

include_once ("../../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$userController = new UserController();
$contractController = new ContractController();

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uriArray = explode("/", $uri);

$userController = new UserController();

switch ($method . ":" . $uriArray[1]) {
    case "GET:user":
        $userController->select($uriArray);
        break;
    case "GET:userAll":
        $userController->selectAll();
        break;
    case "POST:user":
        $userController->create(file_get_contents('php://input'));
        break;
    case "POST:validUserId":
        $userController->selectbyMyid(file_get_contents('php://input'));
        break;
    case "POST:signin":
        $userController->login(file_get_contents('php://input'));
        break;
    case "PUT:user":
        $userController->update($uriArray);
        break;
    case "DELETE:user":
        $userController->delete($uriArray);
    case "POST:contract":
        $contractController->create(file_get_contents('php://input'));
        break;
    case "GET:contractAll":
        $contractController->selectAll();
        break;
    case "GET:contract":
        $contractController->select($uriArray);
        break;
    case "PUT:contract":
        $contractController->update($uriArray);
        break;
    case "PUT:contractComplete":
        $contractController->updatepaybackState($uriArray);
        break;
    case "DELETE:contract":
        $contractController->delete($uriArray);
        break;
    default:
        break;
}
?>