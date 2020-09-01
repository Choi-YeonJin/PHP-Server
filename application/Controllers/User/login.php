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

$myid = $userModel->getMyid();
$password = $userModel->getPassword();
$result = $userDAO->select($myid, $password); // id로 단일 검색
if ($result) {
    $data = ["result" => "true"];

    echo json_encode($data);
} else {
    $data = ["result" => "false"];

    echo json_encode($data);
}
?>
