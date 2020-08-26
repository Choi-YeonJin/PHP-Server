<style>
    p{
        font-size: 13pt;
        font-weight: bold;
        background-color: #ffde838a;
        padding: 8px 10px;
        border-radius: 10px;
        display: inline-block;
    }
</style>
<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * testQuery.php
 */

use Model\UserModel;
use DAO\UserDAO;

include_once ("../application/lib/autoload.php");

$lineStr = "<br><br>---------------------------------------------------<br><br>";
// Tip.... 에러를 확인하고 싶을 경우 사용 -> https://ra2kstar.tistory.com/102 확인
error_reporting(E_ALL);
ini_set("display_errors", 1);

// 1. 파라미터 값 객체에 넣기
// ex) [http://itkoo.site?id=1&name=구지원] 으로 요청했을 경우
$userModel = new UserModel();
$userModel->setByArray($_REQUEST); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
$userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅

// 2. 객체를 json 타입으로 return
echo "<p>1) 파라미터를 객체에 set, 객체를 json 형태로 return</p><br>";
echo $userModel->getJson(new UserModel());
echo $lineStr;


// 3. CRUD
$userDAO = new UserDAO();

// 3-1. INSERT
echo "<p>1) insert, 데이터 삽입</p><br>";
$userId = $userDAO->insert($userModel); // 위에 받았던 (파라미터->객체) insert
//echo "userId : {$userId}".$lineStr;
echo print_r($_REQUEST).$lineStr;

// 3-2. SELECT
echo "<p>3) select, 단일 검색</p><br>";
$id = 1;
var_export($userDAO->select($id)); // id로 단일 검색
echo $lineStr;

echo "<p>4) select, 전체 리스트 검색</p><br>";
$userList = $userDAO->selectAll(); // 전체 리스트 select
foreach ($userList as $userModel){
    echo "id : {$userModel->getId()}, name : {$userModel->getName()}<br>";
}
echo $lineStr;


// 3-3. UPDATE 연진이가 해보기 숙제 ^^
echo "<p>5) update, 연진 숙제 ~ </p><br>";
$name='a';
var_export($userDAO->update($id,$name)); // 위에 받았던 (파라미터->객체) insert
echo $lineStr;
//echo print_r($_REQUEST).$lineStr;

// 3-4. DELETE 연진이가 해보기 숙제 ^^
echo "<p>6) delete, 연진 숙제 ~ </p><br>";