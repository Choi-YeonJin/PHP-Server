<?php

namespace Controllers;

use Model\ContractModel;
use Model\BorrowerModel;
use DAO\ContractDAO;
use DAO\BorrowerDAO;

include_once("../application/lib/autoload.php");

error_reporting(E_ALL);
ini_set("display_errors", 1);

class ContractController
{
    public function create($data)
    {
        $contractModel = new ContractModel();
        $contractDAO = new ContractDAO();

        $borrowerModel = new BorrowerModel();
        $borrowerDAO = new BorrowerDAO();

        $contractModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $contractModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
        $contractModel->setState(0);// 계약서 완료 여부 (defaul=0)

        $B = json_decode($data,true);
        $borrowerNum = count($B['borrower']); //빌리는 사람 수
        for($i=0; $i<$borrowerNum; $i++){
            $borrower = $B['borrower'][$i];
            $borrowerModel->setByArray($borrower);
            $borrowerModel->setCreatedAt(time());
            $borrowerModel->setPaybackState(0);

            $borrowerDAO->insert($borrowerModel); //borrower 테이블 insert

        }

        $contractId = $contractDAO->insert($contractModel); // contract 테이블 insert

        $userId = $B['user_id'];//작성한 user_id
        $data = ["result" => true,
            "userId" => "{$userId}",
            "contractId" => "{$contractId}"];

        return json_encode($data);
    }

    public function select($uriArray)
    {
        $contractDAO = new contractDAO();

        if (!empty($uriArray[2])) { // 파라미터 값 유효성 검사
            $result = $contractDAO->selectbyId($uriArray[2]);
            if (!empty($result)) { // 조회 성공
                $data = ["id" => "{$result->getId()}",
                    "myid" => "{$result->getMyid()}",
                    "password" => "{$result->getPassword()}",
                    "name" => "{$result->getName()}",
                    "imageUrl" => "{$result->getImageUrl()}",
                    "phoneNum" => "{$result->getPhoneNum()}"];
                return json_encode($data, JSON_UNESCAPED_UNICODE);
            } else { // 조회 실패
                $data = ["result" => false];

                return json_encode($data);
            }
        } else { // 파라미터 값 is null
            $data = ["result" => false,
                "errorMessage" => "parameter is null"]; //조회할 유저 id값이 안넘어왔을 때

            return json_encode($data);
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
            return json_encode($data, JSON_UNESCAPED_UNICODE) . "<br>";
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

        if ($uriArray[2]) {
            $result = $contractDAO->updateUserInfo($uriArray[2], $title, $borrorw_date, $payback_date, $price, $lender_id, $lender_name, $penalty, $alarm, $updated_at);
            if ($result > 0) {
                $data = ["result" => "true"];

                return json_encode($data);
            } else {
                $data = ["result" => "false",
                    "errorMessage" => "something data is null"];

                return json_encode($data);
            }
        } else {
            $data = ["result" => "false",
                "errorMessage" => "URL parameter is Not Found"];
            return json_encode($data, JSON_UNESCAPED_UNICODE) . "<br>";
        }
    }

    public function updatepaybackState($uriArray)
    {
        $contractModel = new contractModel();
        $contractModel->setState(1);

        $contractDAO = new contractDAO();

        $state = $contractModel->getState();

        if ($uriArray[2]) {
            $result = $contractDAO->updatePaybackState($uriArray[2], $state);
            if ($result > 0) {
                $data = ["result" => "true"];

                return json_encode($data);
            } else {
                $data = ["result" => "false",
                    "errorMessage" => "something data is null"];

                return json_encode($data);
            }
        } else {
            $data = ["result" => "false",
                "errorMessage" => "URL parameter is Not Found"];
            return json_encode($data, JSON_UNESCAPED_UNICODE) . "<br>";
        }
    }

    public function delete($uriArray)
    {
        $contractModel = new contractModel();

        $contractDAO = new contractDAO();

        $result = $contractDAO->delete($uriArray[2]); // id로 단일 검색
        if ($result != 0) {
            $data = ["result" => "true"];

            return json_encode($data);
        } else {
            $data = ["result" => "false",
                "errorMessage" => "URL parameter is Not Found"];

            return json_encode($data);
        }
    }
}

?>

