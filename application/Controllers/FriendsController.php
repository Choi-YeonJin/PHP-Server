<?php

namespace Controllers;

use Model\FriendsModel;
use Model\WaitFriendsModel;
use DAO\FriendsDAO;
use DAO\WaitFriendsDAO;
use DAO\UserDAO;

include_once("../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

class FriendsController
{
    public function selectFriends($uriArray) //GET friends : 친구 목록 가져오기
    {
        $friendsDAO = new FriendsDAO();

        if (!empty($uriArray[2])) {
            $friensList = $friendsDAO->selectbyUserId($uriArray[2]);

            $friendsJson = array(); // 전체 유저 조회할 배열 선언
            foreach ($friensList as $friendsModel) {
                $data = $friendsModel->getArray();
                array_push($friendsJson, $data); // 위에 선언한 배열에 값 추가
            }

            return json_encode($friendsJson, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE : 한국어 패치
        } else {
            $data = [
                "result" => false,
                "errorMessage" => "parameter is null"
            ];

            return json_encode($data);
        }

    }

    public function selectFavoriteFriends($uriArray) //GET favorite-friends : 즐겨찾기 친구 목록 가져오기
    {
        $friendsDAO = new FriendsDAO();

        if (!empty($uriArray[2])) {
            $friensList = $friendsDAO->selectFavoritebyUserId($uriArray[2]);

            $friendsJson = array(); // 전체 유저 조회할 배열 선언
            foreach ($friensList as $friendsModel) {
                $data = $friendsModel->getArray();
                array_push($friendsJson, $data); // 위에 선언한 배열에 값 추가
            }

            return json_encode($friendsJson, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE : 한국어 패치
        } else {
            $data = [
                "result" => false,
                "errorMessage" => "parameter is null"
            ];

            return json_encode($data);
        }

    }

    public function selectBlockFriends($uriArray) //GET blcok-friends : 차단 친구 목록 가져오기
    {
        $friendsDAO = new FriendsDAO();

        if (!empty($uriArray[2])) {
            $friensList = $friendsDAO->selectBlockbyUserId($uriArray[2]);

            $friendsJson = array(); // 전체 유저 조회할 배열 선언
            foreach ($friensList as $friendsModel) {
                $data = $friendsModel->getArray();
                array_push($friendsJson, $data); // 위에 선언한 배열에 값 추가
            }

            return json_encode($friendsJson, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE : 한국어 패치
        } else {
            $data = [
                "result" => false,
                "errorMessage" => "parameter is null"
            ];

            return json_encode($data);
        }

    }

    public function createWaitFriends() //POST friends : 친구신청
    {
        $waitFriendsModel = new WaitFriendsModel();
        $waitFriendsDAO = new WaitFriendsDAO();
        $userDAO = new UserDAO();
        $waitFriendsModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $waitFriendsModel->setRequestTime(time()); // 시간은 서버 시간으로 세팅
        $waitFriendsModel->setAcceptState(0); //신청 수락 여부 Default=0
        $waitFriendsModel->setApplicantId($waitFriendsModel->getApplicantId()); //현재 로그인 한 유저의 id
        $user = $userDAO->selectbyId($waitFriendsModel->getApplicantId()); //현재 로그인한 유저 정보 select
        $userName = $user->getName(); // 유저의 name
        $waitFriendsModel->setApplicantName($userName); //setName

        $waitFriendsId = $waitFriendsDAO->insert($waitFriendsModel);
        if ($waitFriendsId > 0) {
            $data = ["result" => true,
                "id" => "{$waitFriendsId}",
                "applicantId" => "{$waitFriendsModel->getApplicantId()}",
                "recipendtId" => "{$waitFriendsModel->getRecipientId()}",
            ];

            return json_encode($data);
        } else {
            $data = [
                "result" => false,
                "errorMessage" => "Not insert"
            ];

            return json_encode($data);
        }

    }

    public function createFriends() //POST rqfriends : 친구신청수락
    {
        $waitFriendsModel = new WaitFriendsModel();
        $waitFriendsDAO = new WaitFriendsDAO();

        $friendsModel = new FriendsModel();
        $freindsDAO = new FriendsDAO();
        $waitFriendsModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $waitFriendsModel->setAcceptTime(time()); // 시간은 서버 시간으로 세팅
        $waitFriendsModel->setAcceptState(1); //신청 수락
        $waitFriendsId = $waitFriendsDAO->updateAcceptTime($waitFriendsModel);

        $friendsModel->setCreatedAt(time());
        $waitFriends = $waitFriendsDAO->selectbyId($waitFriendsModel->getId());//신청 사항 id로 조회
        $userId = $waitFriends->getApplicantId();
        $friendsId = $waitFriends->getRecipientId();
        $friendsModel->setUserId($userId);
        $friendsModel->setFriendsId($friendsId);
        $friendsOne = $freindsDAO->insert($friendsModel);
        $friendsModel->setUserId($friendsId);
        $friendsModel->setFriendsId($userId);
        $friendsTwo = $freindsDAO->insert($friendsModel);

        if ($waitFriendsId > 0 and $friendsOne > 0 and $friendsTwo > 0) {
            $data = ["result" => true];

            return json_encode($data);
        } else {
            $data = [
                "result" => false,
                "errorMessage" => "Not update"
            ];

            return json_encode($data);
        }
    }

    public function deleteWaitFriends() //POST refuse-rqfriends : 친구신청거절
    {
        $waitFriendsModel = new WaitFriendsModel();
        $waitFriendsDAO = new WaitFriendsDAO();

        $waitFriendsModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $result = $waitFriendsDAO->delete($waitFriendsModel->getId());
        if (!empty($result)) { //정상적으로 delete
            $data = ["result" => true];

            return json_encode($data);
        } else { // 잘못된 파라미터 값
            $data = ["result" => false,
                "errorMessage" => "id is Not Found"]; //존재하지 않는 id

            return json_encode($data);
        }
    }

    public function updateFriends($uriArray) //PUT friends/favorite or block : 즐겨찾기 or 차단친구 추가
    {
        $friendsModel = new FriendsModel();
        $friendsDAO = new FriendsDAO();

        if (!empty($uriArray[3])) {
            $friendsModel->setUpdatedAt(time());
            if ($uriArray[2] == "favorite") {
                $friendsModel->setFavorite(1);
                $friendsModel->setBlock(0);
                $favorite = $friendsDAO->updatedFavorite($uriArray[3], $friendsModel);

                if ($favorite > 0) {
                    $data = ["result" => true];

                    return json_encode($data);
                } else {
                    $data = [
                        "result" => false,
                        "errorMessage" => "Not update"
                    ];
                    return json_encode($data);
                }
            } else if ($uriArray[2] == "block") {
                $friendsModel->setBlock(1);
                $friendsModel->setFavorite(0);
                $favorite = $friendsDAO->updatedBlock($uriArray[3], $friendsModel);

                if ($favorite > 0) {
                    $data = ["result" => true];

                    return json_encode($data);
                } else {
                    $data = [
                        "result" => false,
                        "errorMessage" => "Not update"
                    ];
                    return json_encode($data);
                }
            } else {
                $data = [
                    "result" => false,
                    "errorMessage" => "parameter is null"
                ];

                return json_encode($data);
            }
        } else {
            $data = [
                "result" => false,
                "errorMessage" => "parameter is null"
            ];

            return json_encode($data);
        }
    }

    public function updateFriendsCancel($uriArray) //PUT cancel-friends/favorite or block : 즐겨찾기 or 차단친구 해제
    {
        $friendsModel = new FriendsModel();
        $friendsDAO = new FriendsDAO();

        if (!empty($uriArray[3])) {
            $friendsModel->setUpdatedAt(time());
            if ($uriArray[2] == "favorite") {
                $friendsModel->setFavorite(0);
                $friendsModel->setBlock(0);
                $favorite = $friendsDAO->updatedFavorite($uriArray[3], $friendsModel);

                if ($favorite > 0) {
                    $data = ["result" => true];

                    return json_encode($data);
                } else {
                    $data = [
                        "result" => false,
                        "errorMessage" => "Not update"
                    ];
                    return json_encode($data);
                }
            } else if ($uriArray[2] == "block") {
                $friendsModel->setBlock(0);
                $friendsModel->setFavorite(0);
                $favorite = $friendsDAO->updatedBlock($uriArray[3], $friendsModel);

                if ($favorite > 0) {
                    $data = ["result" => true];

                    return json_encode($data);
                } else {
                    $data = [
                        "result" => false,
                        "errorMessage" => "Not update"
                    ];
                    return json_encode($data);
                }
            } else {
                $data = [
                    "result" => false,
                    "errorMessage" => "parameter is null"
                ];

                return json_encode($data);
            }
        } else {
            $data = [
                "result" => false,
                "errorMessage" => "parameter is null"
            ];

            return json_encode($data);
        }
    }

    public function deleteFriends() //DELETE friends : 친구 삭제
    {
        $friendsDAO = new FriendsDAO();
        $friendsModel = new FriendsModel();

        $friendsModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $userId = $friendsModel->getUserId();
        $friendsId = $friendsModel->getFriendsId();
        $friendsModel->setUserId($userId);
        $friendsModel->setFriendsId($friendsId);
        $delFriendsOwn = $friendsDAO->delete($friendsModel);

        $friendsModel->setUserId($friendsId);
        $friendsModel->setFriendsId($userId);
        $delFriendsTwo = $friendsDAO->delete($friendsModel);

        if (!empty($delFriendsOwn) and !empty($delFriendsTwo)) { //정상적으로 delete
            $data = ["result" => true];

            return json_encode($data);
        } else { // 잘못된 파라미터 값
            $data = ["result" => false,
                "errorMessage" => "id is Not Found"]; //존재하지 않는 id

            return json_encode($data);
        }
    }
}

?>

