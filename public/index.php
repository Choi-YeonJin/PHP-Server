<?php

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uriArray = explode("/", $uri);


switch ($method . ":" . $uriArray[1]) {
    case "GET:user":
        echo "user get";
        // userController->select($uriArray);
        break;
    case "POST:user":
        // userController->insert(file_get_contents ....);
        break;
    default:
        break;
}
?>