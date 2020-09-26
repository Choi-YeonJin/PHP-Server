<?php

use Controllers\UserController;
use Controllers\ContractController;
use Controllers\FriendsController;

include_once("../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

$userController = new UserController();
$contractController = new ContractController();
$friendsController = new FriendsController();

$method = $_SERVER["REQUEST_METHOD"];
$uri = $_SERVER["REQUEST_URI"];
$uriArray = explode("/", $uri);

switch ($method . ":" . $uriArray[1]) {
    //USER
    case "GET:user": //유저 정보 조회
        $userJson = $userController->select($uriArray);
        echo $userJson;
        break;
    case "GET:users": //전체 유저 조회
        $userJson = $userController->selectAll();
        echo $userJson;
        break;
    case "POST:user": //회원가입
        $userJson = $userController->create(file_get_contents('php://input'));
        echo $userJson;
        break;
    case "POST:valid-userId": //아이디 중복확인
        $userJson = $userController->selectbyMyid(file_get_contents('php://input'));
        echo $userJson;
        break;
    case "POST:sign-in": //로그인
        $userJson = $userController->login(file_get_contents('php://input'));
        echo $userJson;
        break;
    case "POST:select-userByName":
        $userJson = $userController->sleectUserName(file_get_contents('php://input'));
        echo $userJson;
        break;
    case "PUT:user": //유저 정보 수정
        $userJson = $userController->update($uriArray);
        echo $userJson;
        break;
    case "PUT:user-pw": //유저 정보 수정
        $userJson = $userController->updatePw($uriArray);
        echo $userJson;
        break;
    case "PUT:bank-registration": // 유저 은행 정보 insert
        $userJson = $userController->createBankAndAccount($uriArray);
        echo $userJson;
        break;
    case "DELETE:user": //회원탈퇴
        $userJson = $userController->delete($uriArray);
        echo $userJson;
        break;
    //CONTRACT
    case "GET:contracts": //로그인한 유저의 전체 계약서 가져오기
        $contractJson = $contractController->selectAll($uriArray);
        echo $contractJson;
        break;
    case "GET:contract": // 해당 계약서 세부 사항 가져오기
        $contractJson = $contractController->select($uriArray);
        echo $contractJson;
        break;
    case "GET:contract-content":
        $contractJson = $contractController->selectContent($uriArray);
        echo $contractJson;
        break;
    case "GET:contract-contents":
        $contractJson = $contractController->selectContents($uriArray);//현재로그인한 유저
        echo $contractJson;
        break;
    case "POST:contract": //계약서 작성
        $contractJson = $contractController->create(file_get_contents('php://input'));
        echo $contractJson;
        break;
    case "POST:contract-content":
        $contractJson = $contractController->contentCreate(file_get_contents('php://input'));
        echo $contractJson;
        break;
    case "PUT:contract": // 계약서 수정
        $contractJson = $contractController->update($uriArray);
        echo $contractJson;
        break;
    case "PUT:contract-complete": //계약서 완료
        $contractJson = $contractController->updatepaybackState($uriArray);
        echo $contractJson;
        break;
    case "DELETE:contract": // 계약서 삭제
        $contractJson = $contractController->delete($uriArray);
        echo $contractJson;
        break;
    //FRIENDS
    case "GET:friends": // 현재 로그인 한 유저의 친구 목록 불러오기
        $friendsJson = $friendsController->selectFriends($uriArray);
        echo $friendsJson;
        break;
    case "GET:request-friends": // 현재 로그인 한 유저의 친구 신청 목록 불러오기
        $friendsJson = $friendsController->selectAllReqFriends($uriArray);
        echo $friendsJson;
        break;
    case "GET:request-friend": // 현재 로그인 한 유저의 친구 신청 목록 불러오기
        $friendsJson = $friendsController->selectReqFriends($uriArray);
        echo $friendsJson;
        break;
    case "GET:favorite-friends": // 즐겨찾기 친구 목록 불러오기
        $friendsJson = $friendsController->selectFavoriteFriends($uriArray);
        echo $friendsJson;
        break;
    case "GET:block-friends": // 차단친구 목록 불러오기
        $friendsJson = $friendsController->selectBlockFriends($uriArray);
        echo $friendsJson;
        break;
    case "POST:friends": //친구 신청 보내기
        $friendsJson = $friendsController->createWaitFriends();
        echo $friendsJson;
        break;
    case "POST:rqfriends": //친구 신청 수락
        $friendsJson = $friendsController->createFriends();
        echo $friendsJson;
        break;
    case "POST:refuse-rqfriends": //친구 신청 거절
        $friendsJson = $friendsController->deleteWaitFriends();
        echo $friendsJson;
        break;
    case "PUT:friends": // 즐겨찾기/차단친구 추가
        $friendsJson = $friendsController->updateFriends($uriArray); //해당 friends id
        echo $friendsJson;
        break;
    case "PUT:cancel-friends": // 즐겨찾기/차단친구 해제
        $friendsJson = $friendsController->updateFriendsCancel($uriArray); //해당 friends id
        echo $friendsJson;
        break;
    case "DELETE:friends": // 친구 삭제하기
        $friendsJson = $friendsController->deleteFriends();
        echo $friendsJson;
        break;
    default:
        break;
}
?>