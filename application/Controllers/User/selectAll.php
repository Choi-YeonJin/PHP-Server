<?php

use Model\UserModel;
use DAO\UserDAO;

include_once("../../../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$userModel = new UserModel();
$userDAO = new UserDAO();

$userList = $userDAO->selectAll(); // 전체 리스트 select

foreach ($userList as $userModel) {
    echo "id : {$userModel->getId()}, name : {$userModel->getName()}<br>";
}
?>
