<?php

use DAO\ContractDAO;
use Model\ContractModel;

include_once("../../../application/lib/autoload.php");

$lineStr = "<br><br>---------------------------------------------------<br><br>";
// Tip.... 에러를 확인하고 싶을 경우 사용 -> https://ra2kstar.tistory.com/102 확인
error_reporting(E_ALL);
ini_set("display_errors", 1);

// 1. 파라미터 값 객체에 넣기
$contractModel = new ContractModel();
$contractModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
$contractModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
$contractModel->setUpdatedAt(time()); // 시간은 서버 시간으로 세팅
$contractModel->setState(0); // 시간은 서버 시간으로 세팅

//$borrowerModel = new BorrowerModel();
//$borrowerModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
//$borrowerModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅

//CRUD
$contractDAO = new ContractDAO();

$userId =  $contractDAO->insert($contractModel);

if($userId != 0){
    $data = ["result" => "true",
        "userId" => "{$userId}"];

    echo json_encode($data);
}else{
    $data = ["result" => "false"];

    echo json_encode($data);
}


//$contractList = $contractDAO->selectAll(); // 전체 리스트 select
//foreach ($contractList as $contractModel){
//    echo "id : {$contractModel->getId()}, name : {$contractModel->getBorrowDate()}<br>";
//}
//echo $lineStr;

?>