<?php
use Model\UserModel;
use DAO\UserDAO;

include_once ("../../application/lib/autoload.php");

$lineStr = "<br><br>---------------------------------------------------<br><br>";
// Tip.... 에러를 확인하고 싶을 경우 사용 -> https://ra2kstar.tistory.com/102 확인
error_reporting(E_ALL);
ini_set("display_errors", 1);

// 1. 파라미터 값 객체에 넣기
// ex) [http://itkoo.site?id=1&name=구지원] 으로 요청했을 경우
$userModel = new UserModel();
// 3. CRUD
$userDAO = new UserDAO();

$userList = $userDAO->selectAll(); // 전체 리스트 select
foreach ($userList as $userModel){
    echo "id : {$userModel->getId()}, name : {$userModel->getName()}<br>";
}
echo $lineStr;
?>
