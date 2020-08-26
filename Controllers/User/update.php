<?php
use Model\UserModel;
use DAO\UserDAO;

include_once ("../../application/lib/autoload.php");

$lineStr = "<br><br>---------------------------------------------------<br><br>";
// Tip.... 에러를 확인하고 싶을 경우 사용 -> https://ra2kstar.tistory.com/102 확인
//error_reporting(E_ALL);
//ini_set("display_errors", 1);

// 1. 파라미터 값 객체에 넣기
// ex) [http://itkoo.site?id=1&name=구지원] 으로 요청했을 경우
$userModel = new UserModel();
$userModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
$userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅

// 2. 객체를 json 타입으로 return
echo "<p>1) 파라미터를 객체에 set, 객체를 json 형태로 return</p><br>";
echo $userModel->getJson(new UserModel());
echo $lineStr;


// 3. CRUD
$userDAO = new UserDAO();


echo "<p>5) update, 연진 숙제 ~ </p><br>";
$id = $userModel->getId();
$name = $userModel->getName();
$userId = $userDAO->update($id,$name); // 위에 받았던 (파라미터->객체) insert
echo "userId : {$userId}".$lineStr;
//echo print_r($_REQUEST).$lineStr;
?>
