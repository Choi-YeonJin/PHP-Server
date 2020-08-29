<?php

use DAO\ContractDAO;
use Model\ContractModel;

include_once ("../../application/lib/autoload.php");

$lineStr = "<br><br>---------------------------------------------------<br><br>";
// Tip.... 에러를 확인하고 싶을 경우 사용 -> https://ra2kstar.tistory.com/102 확인
error_reporting(E_ALL);
ini_set("display_errors", 1);

// 1. 파라미터 값 객체에 넣기
// ex) [http://itkoo.site?id=1&name=구지원] 으로 요청했을 경우
$contractModel = new ContractModel();
$contractModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
$contractModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
$contractModel->setUpdatedAt(time()); // 시간은 서버 시간으로 세팅
$contractModel->setState(0); // 시간은 서버 시간으로 세팅

//$borrowerModel = new BorrowerModel();
//$borrowerModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
//$borrowerModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅

// 2. 객체를 json 타입으로 return
echo "<p>1) 파라미터를 객체에 set, 객체를 json 형태로 return</p><br>";
echo $contractModel->getJson(new ContractModel());
echo $lineStr;

//CRUD
$contractDAO = new ContractDAO();

//$id=$contractModel->getId();
//$title=$contractModel->getTitle();
//$borrowDate=$contractModel->getBorrowDate();
//$paybackDate=$contractModel->getPaybackDate();
//$price=$contractModel->getPrice();
//$lender_id = $contractModel->getLenderId();
//$name = $contractModel->getLenderName();
//$penalty = $contractModel->getPenalty();
$userId =  $contractDAO->insert($contractModel);

echo "userId : {$userId}";

//$contractList = $contractDAO->selectAll(); // 전체 리스트 select
//foreach ($contractList as $contractModel){
//    echo "id : {$contractModel->getId()}, name : {$contractModel->getBorrowDate()}<br>";
//}
//echo $lineStr;

?>