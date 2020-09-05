<?php

use Controllers\UserController;
use Controllers\ContractController;

include_once ("../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$userController = new UserController();
$contractController = new ContractController();

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uriArray = explode("/", $uri);

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
        $contractJson = $contractController->create(file_get_contents('php://input'));
        echo $contractJson;
        break;
    case "GET:contracts":
        $contractJson = $contractController->selectAll();
        echo $contractJson;
        break;
    case "GET:contract":
        $contractJson = $contractController->select($uriArray);
        echo $contractJson;
        break;
    case "PUT:contract":
        $contractJson = $contractController->update($uriArray);
        echo $contractJson;
        break;
    case "PUT:contract-complete":
        $contractJson = $contractController->updatepaybackState($uriArray);
        echo $contractJson;
        break;
    case "DELETE:contract":
        $contractJson = $contractController->delete($uriArray);
        echo $contractJson;
        break;
    default:
        break;
}
?>