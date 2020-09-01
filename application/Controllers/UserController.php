<?php

namespace Controllers;

use Model\UserModel;
use DAO\UserDAO;

include_once("../../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

class UserController
{
    public function create($data)
    {
        $userModel = new UserModel();
        $userDAO = new UserDAO();
        $userModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
        $userModel->setUpdatedAt(time()); // 시간은 서버 시간으로 세팅

        $myid = $userModel->getMyid();

        //name 중복검사
        $result = $userDAO->selectmyidByID($myid);

        if ($result == 0) {
            $userId = $userDAO->insert($userModel); // 위에 받았던 (파라미터->객체) insert

            $data = ["result" => "true",
                "userId" => "{$userId}"];

            echo json_encode($data);
        } else {
            $data = ["result" => "false",
                "errorMessage" => "ID is alreay taken"];

            echo json_encode($data);
        }
    }

    public function login($data)
    {
        $userModel = new UserModel();
        $userModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
        $userModel->setUpdatedAt(time()); // 시간은 서버 시간으로 세팅

        $userDAO = new UserDAO();

        $myid = $userModel->getMyid();
        $password = $userModel->getPassword();
        $result = $userDAO->select($myid, $password); // id로 단일 검색
        if ($result) {
            $data = ["result" => "true",
                "userId"=>"{$result->getId()}"];

            echo json_encode($data);
        } else {
            $data = ["result" => "false"];

            echo json_encode($data);
        }
    }

    public function select($uriArray)
    {
        $userModel = new UserModel();

        $userDAO = new UserDAO();

        var_export($userDAO->selectbyId($uriArray[2])); // id로 단일 검색
    }

    public function update($uriArray)
    {
        $userModel = new UserModel();
        $userModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set

        $userDAO = new UserDAO();

        $name = $userModel->getName();
        $password = $userModel->getPassword();
        $result = $userDAO->updateUserInfo($uriArray[2],$name,$password); // id로 단일 검색
        if ($result != 0) {
            $data = ["result" => "true"];

            echo json_encode($data);
        } else {
            $data = ["result" => "false"];

            echo json_encode($data);
        }
    }

    public function delete($uriArray)
    {
        $userModel = new UserModel();

        $userDAO = new UserDAO();

        $result = $userDAO->delete($uriArray[2]); // id로 단일 검색
        if ($result != 0) {
            $data = ["result" => "true"];

            echo json_encode($data);
        } else {
            $data = ["result" => "false"];

            echo json_encode($data);
        }
    }
}

?>