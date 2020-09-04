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

$userController = new UserController();

switch ($method . ":" . $uriArray[1]) {
    case "GET:user":
        $userJson = $userController->select($uriArray);
        echo $userJson;
        break;
    case "GET:users":
        $userJson = $userController->selectAll();
        echo $userJson;
        break;
    case "POST:user":
        $userJson = $userController->create(file_get_contents('php://input'));
        echo $userJson;
        break;
    case "POST:valid-userId":
        $userJson = $userController->selectbyMyid(file_get_contents('php://input'));
        echo $userJson;
        break;
    case "POST:sign-in":
        $userJson = $userController->login(file_get_contents('php://input'));
        echo $userJson;
        break;
    case "PUT:user":
        $userJson = $userController->update($uriArray);
        echo $userJson;
        break;
    case "PUT:bank-registration":
        $userJson = $userController->createBankAndAccount($uriArray);
        echo $userJson;
        break;
    case "DELETE:user":
        $userJson = $userController->delete($uriArray);
        echo $userJson;
        break;
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