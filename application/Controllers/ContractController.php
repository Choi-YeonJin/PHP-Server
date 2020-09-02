<?php

namespace Controllers;

use Model\ContractModel;
use DAO\ContractDAO;

include_once("../../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

class ContractController
{
    public function create($data)
    {
        $contractModel = new ContractModel();
        $contractDAO = new ContractDAO();
        $contractModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $contractModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
        $contractModel->setUpdatedAt(time()); // 시간은 서버 시간으로 세팅
        $contractModel->setState(0); // 시간은 서버 시간으로 세팅

        $contractDAO = new ContractDAO();

        $contractId =  $contractDAO->insert($contractModel);

        if($contractId != 0){
            $data = ["result" => "true",
                "contractId" => "{$contractId}"];

            echo json_encode($data);
        }else{
            $data = ["result" => "false"];

            echo json_encode($data);
        }
    }


    public function select($uriArray)
    {
        $contractModel = new contractModel();

        $contractDAO = new contractDAO();
        if($uriArray[2])
        {
            var_export($contractDAO->selectbyId($uriArray[2])); // id로 단일 검색
        }else{
            $data = ["result" => "false",
                "errorMessage" => "URL parameter is Not Found"];
            echo json_encode($data, JSON_UNESCAPED_UNICODE)."<br>";
        }

    }

    public function selectAll()
    {
        $contractModel = new contractModel();
        $contractDAO = new contractDAO();

        $userList = $contractDAO->selectAll(); // 전체 리스트 select
        foreach ($userList as $contractModel) {
            $data = ["id" => "{$contractModel->getId()}",
                "Title" => "{$contractModel->getTitle()}",
                "Borrow_date" => "{$contractModel->getBorrowDate()}",
                "Payback_date" => "{$contractModel->getPaybackDate()}",
                "Price" => "{$contractModel->getPrice()}",
                "Lender_name" => "{$contractModel->getLenderName()}",
                "Penalty" => "{$contractModel->getPenalty()}"];
            echo json_encode($data, JSON_UNESCAPED_UNICODE)."<br>";
        }
    }

    public function update($uriArray)
    {
        $contractModel = new contractModel();
        $contractModel->setByArray(json_decode(file_get_contents('php://input'))); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $contractModel->setUpdatedAt(time());

        $contractDAO = new contractDAO();

        $title = $contractModel->getTitle();
        $borrorw_date = $contractModel->getBorrowDate();
        $payback_date = $contractModel->getPaybackDate();
        $price = $contractModel->getPrice();
        $lender_id = $contractModel->getLenderId();
        $lender_name = $contractModel->getLenderName();
        $penalty = $contractModel->getPenalty();
        $alarm = $contractModel->getAlarm();
        $updated_at = $contractModel->getUpdatedAt();

        if($uriArray[2]){
            $result = $contractDAO->updateUserInfo($uriArray[2],$title,$borrorw_date,$payback_date,$price,$lender_id,$lender_name,$penalty,$alarm,$updated_at);
            if ($result > 0) {
                $data = ["result" => "true"];

                echo json_encode($data);
            } else {
                $data = ["result" => "false",
                "errorMessage"=>"something data is null"];

                echo json_encode($data);
            }
        }else{
            $data = ["result" => "false",
                "errorMessage" => "URL parameter is Not Found"];
            echo json_encode($data, JSON_UNESCAPED_UNICODE)."<br>";
        }
    }

    public function updatepaybackState($uriArray)
    {
        $contractModel = new contractModel();
        $contractModel->setState(1);

        $contractDAO = new contractDAO();

        $state = $contractModel->getState();

        if($uriArray[2]){
            $result = $contractDAO->updatePaybackState($uriArray[2],$state);
            if ($result > 0) {
                $data = ["result" => "true"];

                echo json_encode($data);
            } else {
                $data = ["result" => "false",
                    "errorMessage"=>"something data is null"];

                echo json_encode($data);
            }
        }else{
            $data = ["result" => "false",
                "errorMessage" => "URL parameter is Not Found"];
            echo json_encode($data, JSON_UNESCAPED_UNICODE)."<br>";
        }
    }


    public function delete($uriArray)
    {
        $contractModel = new contractModel();

        $contractDAO = new contractDAO();

        $result = $contractDAO->delete($uriArray[2]); // id로 단일 검색
        if ($result != 0) {
            $data = ["result" => "true"];

            echo json_encode($data);
        } else {
            $data = ["result" => "false",
                "errorMessage" => "URL parameter is Not Found"];

            echo json_encode($data);
        }
    }
}

?>

