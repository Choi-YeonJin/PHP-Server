<?php

use Controllers\UserController;

include_once ("application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);


$userController = new UserController();
$url = parse_url($_SERVER['REQUEST_URI'],PHP_URL_PATH);
$url = explode('/',$url);
$requestMethod = $_SERVER['REQUEST_METHOD'];

if($url[2]=='users'){
        switch ($requestMethod){
                case 'GET':
                        $userController->select($_GET);
                        break;
                case 'POST':
                        $userController->create();
                        break;
                case 'PUT':
                        $userController->update();
                        break;
                case 'DELETE':
                        $userController->delete($_GET);
        }

}
?>
