<?php

use Model\UserModel;
use DAO\UserDAO;

include_once("../../../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$userModel = new UserModel();
$userModel->setByArray($_REQUEST); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
$userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
$userModel->setUpdatedAt(time()); // 시간은 서버 시간으로 세팅

// 2. 객체를 json 타입으로 return
echo "<p>1) 파라미터를 객체에 set, 객체를 json 형태로 return</p><br>";
echo $userModel->getJson(new UserModel());
echo $lineStr;

$userDAO = new UserDAO();

$id = $userModel->getId();
$userDAO->delete($id);
echo "userId : {$id}" . $lineStr;
?>
