<?php

use Model\UserModel;
use DAO\UserDAO;

include_once("../../../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$userModel = new UserModel();
$userModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
$userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
$userModel->setUpdatedAt(time()); // 시간은 서버 시간으로 세팅

$userDAO = new UserDAO();

$id = $userModel->getId();
$name = $userModel->getName();
$password = $userModel->getPassword();
// 계좌번호도 변경

$result = $userDAO->updateUserInfo($id, $name, $password); // 위에 받았던 (파라미터->객체) insert

if ($result != 0) {
    $data = ["result" => "true"];
    echo json_encode($data);
} else {
    $data = ["result" => "false"];
    echo json_encode($data);
}
?>
