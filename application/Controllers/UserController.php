<?php

namespace Controllers;
use Model\UserModel;
use DAO\UserDAO;

include_once("application/lib/autoload.php");

class UserController
{

    public function create(){
        $userModel = new UserModel();
        $userDAO = new UserDAO();
        $userModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $userModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
        echo "create";
    }

    public function update($userModel){
    }

    public function select($userId){
    }

    public function delete($userId){
    }
}

?>