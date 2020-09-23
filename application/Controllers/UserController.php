<?php

namespace Controllers;

use Model\UserModel;
use DAO\UserDAO;

include_once("../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

class UserController
{
    public function select($uriArray) //GET user : 개인 회원 조회
    {
        $userDAO = new UserDAO();

        if(!empty($uriArray[2])){ // 파라미터 값 유호성 검사
            $result = $userDAO->selectbyId($uriArray[2]);
            if(!empty($result)){ // 조회 성공
                $data = ["id" => "{$result->getId()}",
                    "myid" => "{$result->getMyid()}",
                    "password" => "{$result->getPassword()}",
                    "name" => "{$result->getName()}",
                    "imageUrl" => "{$result->getImageUrl()}",
                    "phoneNum" => "{$result->getPhoneNum()}",
                    "bank" => "{$result->getBank()}",
                    "account" => "{$result->getAccount()}"];
                return json_encode($data, JSON_UNESCAPED_UNICODE);
            }else{ // 조회 실패
                $data = ["result" => false];

                return json_encode($data);
            }
        }else{ // 파라미터 값 is null
            $data = ["result" => false,
                "errorMessage" => "parameter is null"]; //조회할 유저 id값이 안넘어왔을 때

            return json_encode($data);
        }

    }

    public function selectAll() //GET userAll : 전체 회원 조회
    {
        $userDAO = new UserDAO();

        $userList = $userDAO->selectAll(); // 전체 리스트 select

        $userJson = array(); // 전체 유저 조회할 배열 선언
        foreach ($userList as $userModel) {
            $data = $userModel->getArray();
            array_push($userJson, $data); // 위에 선언한 배열에 값 추가
        }

        return json_encode($userJson, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE : 한국어 패치
    }

    public function create($data) //POST user : 회원가입
    {
        $userModel = new UserModel();
        $userDAO = new UserDAO();
        $userModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅

        $userId = $userDAO->insert($userModel);

        $data = ["result" => true,
            "userId" => "{$userId}"];

        return json_encode($data);
    }

    public function selectbyMyid($data) //POST validUserId : 아이디 중복확인
    {
        $userModel = new UserModel();
        $userDAO = new UserDAO();

        $userModel->setByArray(json_decode($data)); //body에 담긴 data를 객체에 맞게끔 변형

        $myid = $userModel->getMyid();

        $userModel = $userDAO->selectByMyid($myid);

        if (empty($userModel)) { //겹치는 아이디가 없을 시
            $data = ["result" => true];

            return json_encode($data);
        } else { // DB에 똑같은 ID가 있을 시
            $data = ["result" => false,
                "errorMessage" => "ID is alreay taken"];

            return json_encode($data);
        }

    }

    public function login($data) //POST sign-in : 로그인
    {
        $userModel = new UserModel();
        $userModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅

        $userDAO = new UserDAO();

        $myid = $userModel->getMyid();
        $password = $userModel->getPassword();

        $userModel = $userDAO->selectByMyIDAndPassword($myid, $password);
        if (!empty($userModel)) { // 로그인 성공
            $data = ["result" => true,
                "userId" => "{$userModel->getId()}"];

            return json_encode($data);
        } else { // 로그인 실패
            $data = ["result" => false];

            return json_encode($data);
        }
    }

    public function sleectUserName($data) //POST select-userByName : name으로 유저 select하기
    {
        $userModel = new UserModel();
        $userModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set세팅

        $userDAO = new UserDAO();

        $userList = $userDAO->selectbyUserName($userModel);
//        var_export($userList);
        $userJson = array(); // 전체 유저 조회할 배열 선언
        foreach ($userList as $userModel) {
            $data = $userModel->getArray();
//            echo $data;
            array_push($userJson, $data); // 위에 선언한 배열에 값 추가
        }
        return json_encode($userJson, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE : 한국어 패치
    }

    public function update($uriArray) //PUT user : 유저 정보 수정
    {
        $userModel = new UserModel();
        $userModel->setByArray(json_decode(file_get_contents('php://input'))); // body에 담긴 data 객체에 맞게끔 변형, data set

        $userDAO = new UserDAO();

        if(!empty($uriArray[2])){ // 파라미터 유효성 검사
            $user = $this->select($uriArray);
            if(empty($userModel->getPassword())) //Image 변경시
            {
                $userPw = json_decode($user)->password;
                $userModel->setPassword($userPw);
            }else if(empty($userModel->getImageUrl())) {
                $userImage = json_decode($user)->imageUrl;
                $userModel->setImageUrl($userImage);
            }
            $result = $userDAO->update($uriArray[2],$userModel);

            if (!empty($result)) { // 유저 비밀번호, 이름 업데이트 성공
                $data = ["result" => true];

                return json_encode($data);
            } else { // 잘못된 파라미터값
                $data = ["result" => false,
                    "errorMessage" => "id is Not Found"]; //존재하지 않는 id

                return json_encode($data);
            }
        }else { // 파라미터값 is null
            $data = ["result" => false,
                "errorMessage" => "parameter is null"]; //수정할 유저 id값이 안넘어왔을 때

            return json_encode($data);
        }

    }

    public function updatePw($uriArray) //PUT user-pw : 유저 비밀번호 수정
    {
        $userModel = new UserModel();
        $userModel->setByArray(json_decode(file_get_contents('php://input'))); // body에 담긴 data 객체에 맞게끔 변형, data set

        $userDAO = new UserDAO();

        if(!empty($uriArray[2])){ // 파라미터 유효성 검사
            $result = $userDAO->updatePw($uriArray[2],$userModel);
            if (!empty($result)) { // 유저 비밀번호, 이름 업데이트 성공
                $data = ["result" => true];

                return json_encode($data);
            } else { // 잘못된 파라미터값
                $data = ["result" => false,
                    "errorMessage" => "id is Not Found "]; //존재하지 않는 id

                return json_encode($data);
            }
        }else{ // 파라미터값 is null
            $data = ["result" => false,
                "errorMessage" => "parameter is null"]; //수정할 유저 id값이 안넘어왔을 때

            return json_encode($data);
        }

    }

    public function createBankAndAccount($uriArray) //PUT bank-registration : 유저 계좌 정보 등록
    {
        $userModel = new UserModel();
        $userModel->setByArray(json_decode(file_get_contents('php://input'))); // body에 담긴 data 객체에 맞게끔 변형, data set

        $userDAO = new UserDAO();

        if(!empty($uriArray[2])){ // 파라미터 유효성 검사
            $result = $userDAO->updateBankAndAccount($uriArray[2],$userModel);
            if (!empty($result)) { // 유저 비밀번호, 이름 업데이트 성공
                $data = ["result" => true];

                return json_encode($data);
            } else { // 잘못된 파라미터값
                $data = ["result" => false,
                    "errorMessage" => "id is Not Found "]; //존재하지 않는 id

                return json_encode($data);
            }
        }else{ // 파라미터값 is null
            $data = ["result" => false,
                "errorMessage" => "parameter is null"]; //수정할 유저 id값이 안넘어왔을 때

            return json_encode($data);
        }
    }

    public function delete($uriArray) //DELETE user : 유저 삭제
    {
        $userDAO = new UserDAO();

        if(!empty($uriArray[2])){ // 파라미터 유효성 검사
            $result = $userDAO->delete($uriArray[2]);
            if (!empty($result)) { //정상적으로 delete
                $data = ["result" => true]; 

                return json_encode($data);
            } else { // 잘못된 파라미터 값
                $data = ["result" => false,
                    "errorMessage" => "id is Not Found"]; //존재하지 않는 id

                return json_encode($data);
            }
        }else{ //파라미터값 is null
            $data = ["result" => false,
                "errorMessage" => "parameter is null"]; //삭제할 유저 id값이 안넘어왔을 때

            return json_encode($data);
        }



    }
}

?>