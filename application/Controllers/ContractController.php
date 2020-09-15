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
    public function selectAll($uriArray) //GET contacts : 현재 로그인 한 사용자의 전체 계약서 조회
    {
        $contractDAO = new ContractDAO();
        $borrowerDAO = new BorrowerDAO();

        if (!empty($uriArray[2])) {

            $lenderList = $contractDAO->selectByUserId($uriArray[2]); // contract table에서 lender_id가 user_id인 list
            $borrowerList = $borrowerDAO->selectByUserId($uriArray[2]); // borrower table에서 borrower_id가 user_id인 list

            $borrowerJson = array(); // if(empty(lenderList))
            $lenderJson = array(); // if(empty(borrowerList))
            $borrowerANDlenderJson = array(); // lenderList와 borrowerList 둘 다 Not empty
            $contracts = array();

            if (!empty($lenderList) or !empty($borrowerList)) {

                if (empty($lenderList)) {
                    foreach ($borrowerList as $borrowerModel) {
                        $data = $borrowerModel->getContractId();
                        array_push($borrowerJson, $data); // 위에 선언한 배열에 값 추가
                    }
                    $userContractJson = $borrowerJson;

                } else if (empty($borrowerList)) {
                    foreach ($lenderList as $lenderModel) {
                        $data = $lenderModel->getId();
                        array_push($lenderJson, $data); // 위에 선언한 배열에 값 추가
                    }
                    $userContractJson = $lenderJson;

                } else {
                    foreach ($borrowerList as $borrowerModel) {
                        $data = $borrowerModel->getContractId();
                        array_push($borrowerANDlenderJson, $data); // 위에 선언한 배열에 값 추가
                    }
                    foreach ($lenderList as $lenderModel) {
                        $data = $lenderModel->getId();
                        array_push($borrowerANDlenderJson, $data); // 위에 선언한 배열에 값 추가
                    }
                    $userContractJson = $borrowerANDlenderJson;
                }

                foreach ($userContractJson as $item) {
                    $contract = $this->selects($item);
                    array_push($contracts, $contract);

                }
                return json_encode($contracts, JSON_UNESCAPED_UNICODE);

            } else {
                $data = ["result" => false,
                    "errorMessage" => "Contract is Not Found"];

                return json_encode($data);
            }

        } else {
            $data = ["result" => false,
                "errorMessage" => "parameter is null"];

            return json_encode($data);
        }

    }

    public function selects($id) // selectAll :
    {
        $contractDAO = new contractDAO();

        if (!empty($id)) { // 파라미터 값 유효성 검사
            $result = $contractDAO->selectbyId($id);

            if (!empty($result)) { // 조회 성공

                $borrowerList = $this->selectAllBorrower($result->getId()); //해당 계약서의 borrower 전체 조회

                $data = ["title" => "{$result->getTitle()}",
                    "borrowDate" => "{$result->getBorrowDate()}",
                    "paybackDate" => "{$result->getPaybackDate()}",
                    "price" => "{$result->getPrice()}",
                    "lenderName" => "{$result->getLenderName()}",
                    "lenderBank" => "{$result->getLenderBank()}",
                    "lenderAccount" => "{$result->getLenderAccount()}",
                    "borrower" => $borrowerList,
                    "penalty" => "{$result->getPenalty()}",
                    "alarm" => "{$result->getAlarm()}",
                    "state" => "{$result->getState()}"];

                return $data;

            } else { // 조회 실패
                $data = ["result" => false];

                return json_encode($data);
            }
        } else { // 파라미터 값 is null
            $data = ["result" => false,
                "errorMessage" => "id is null"]; //조회할 유저 id값이 안넘어왔을 때

            return json_encode($data);
        }
    }

    public function select($uriArray) //GET contract : 계약서 조회
    {
        $contractDAO = new contractDAO();

        if (!empty($uriArray[2])) { // 파라미터 값 유효성 검사
            $result = $contractDAO->selectbyId($uriArray[2]);

            if (!empty($result)) { // 조회 성공

                $borrowerList = $this->selectAllBorrower($result->getId()); //해당 계약서의 borrower 전체 조회

                $data = ["title" => "{$result->getTitle()}",
                    "borrowDate" => "{$result->getBorrowDate()}",
                    "paybackDate" => "{$result->getPaybackDate()}",
                    "price" => "{$result->getPrice()}",
                    "lenderName" => "{$result->getLenderName()}",
                    "lenderBank" => "{$result->getLenderBank()}",
                    "lenderAccount" => "{$result->getLenderAccount()}",
                    "borrower" => $borrowerList,
                    "penalty" => "{$result->getPenalty()}",
                    "alarm" => "{$result->getAlarm()}",
                    "state" => "{$result->getState()}"];

                $contractList = json_encode($data, JSON_UNESCAPED_UNICODE);

                return $contractList;
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

    public function selectAllBorrower($contract_id) //select : contract_id를 가진 borrower 전체 조회
    {
        $borrowerDAO = new BorrowerDAO();

        $borrowerList = $borrowerDAO->selectByContractId($contract_id); // contract_id를 가진 borrower selcet

        $borrorwerJson = array(); // contract_id를 가진 borrower 조회할 배열 선언
        foreach ($borrowerList as $borrowerModel) {
            $data = $borrowerModel->getArray();
            array_push($borrorwerJson, $data); // 위에 선언한 배열에 값 추가
        }

        return $borrorwerJson;
//        return json_encode($borrorwerJson, JSON_UNESCAPED_UNICODE); //JSON_UNESCAPED_UNICODE : 한국어 패치
    }

    public function create($data) //POST contract : 계약서 insert
    {
        $contractModel = new ContractModel();
        $contractDAO = new ContractDAO();

        $borrowerModel = new BorrowerModel();
        $borrowerDAO = new BorrowerDAO();

        $contractModel->setByArray(json_decode($data)); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $contractModel->setCreatedAt(time()); // 시간은 서버 시간으로 세팅
        $contractModel->setState(0);// 계약서 완료 여부 (defaul=0)

        $contractId = $contractDAO->insert($contractModel); // contract 테이블 insert

        if ($contractId > 0) { // 성공적인 계약서 insert
            $body = json_decode($data, true); // body에 담긴 data를 객체에 맞게끔 변형

            $borrowerNum = count($body['borrower']); //빌리는 사람 수

            for ($i = 0; $i < $borrowerNum; $i++) { //빌리는 사람 수만큼 insert

                $borrower = $body['borrower'][$i];

                if (empty($borrower['borrower_id'])) // 비회원인 경우, 관리자 유저 id값을 넣어줌
                {
                    $borrower['borrower_id'] = 41;
                }
                $borrowerModel->setByArray($borrower);
                $borrowerModel->setCreatedAt(time());
                $borrowerModel->setPaybackState(0);
                $borrowerModel->setContractId($contractId);

                $borrowerId = $borrowerDAO->insert($borrowerModel); //borrower 테이블 insert

                if ($borrowerId == 0) { // borrower insert 실패
                    $data = ["result" => false,
                        "errorMessage" => "contract_id or borrower_id is Not Found"];

                    return json_encode($data);
                }

            }

            $userId = $body['user_id'];//작성한 user의 id

            $data = ["result" => true,
                "userId" => "{$userId}",
                "contractId" => "{$contractId}"];

            return json_encode($data);
        } else {
            $data = ["result" => false,
                "errorMessage" => "lender_id is Not Found"];

            return json_encode($data);
        }


    }

    public function update($uriArray) //PUT contract : 계약서 수정
    {
        $contractModel = new contractModel();
        $contractDAO = new contractDAO();

        $borrowerModel = new BorrowerModel();
        $borrowerDAO = new BorrowerDAO();

        $data = json_decode(file_get_contents('php://input'), true);
        $contractModel->setByArray($data); // 요청받은 파라미터를 객체에 맞게끔 변형, data set
        $contractModel->setUpdatedAt(time());

        if (!empty($uriArray[2])) { // 정상적인 파라미터 값

            $result = $contractDAO->updateContractInfo($uriArray[2], $contractModel);

            if (!empty($result)) { // 정상적인 contract update

                $borrowerNum = count($data['borrower']); //빌리는 사람 수

                $borrowerDAO->delete($uriArray[2]); // borrower에서 현재 수정중인 contract_id를 가진 컬럼 모두 삭제

                for ($i = 0; $i < $borrowerNum; $i++) { //빌리는 사람 수만큼 insert
                    $borrower = $data['borrower'][$i];

                    if (empty($borrower['borrower_id'])) // 비회원인 경우, 관리자 유저 id값을 넣어줌
                    {
                        $borrower['borrower_id'] = 41;
                    }
                    $borrowerModel->setByArray($borrower);
                    $borrowerModel->setUpdatedAt(time());
                    $borrowerModel->setContractId($uriArray[2]);
                    $borrowerModel->setPaybackState(0);

                    $borrowerId = $borrowerDAO->insertBycontractId($borrowerModel); //borrower 테이블 insert
                    if (empty($borrowerId)) { // borrower insert 실패
                        $data = ["result" => false,
                            "errorMessage" => "contract_id or borrower_id is Not Found"];

                        return json_encode($data);
                    }
                }
                $data = ["result" => true];

                return json_encode($data);
            } else {
                $data = ["result" => false,
                    "errorMessage" => "id is Not Found"];

                return json_encode($data);
            }
        } else {
            $data = ["result" => false,
                "errorMessage" => "parameter is null"];
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }

    public function updatepaybackState($uriArray) //PUT contract-complete : 계약서 완료
    {
        $contractModel = new contractModel();
        $contractModel->setState(1);

        $contractDAO = new contractDAO();

        $state = $contractModel->getState();

        if (!empty($uriArray[2])) {
            $result = $contractDAO->updatePaybackState($uriArray[2], $state);
            if (!empty($result)) {
                $data = ["result" => true];

                return json_encode($data);
            } else {
                $data = ["result" => false,
                    "errorMessage" => "id is Not Found"];

                return json_encode($data);
            }
        } else {
            $data = ["result" => false,
                "errorMessage" => "parameter is Not Found"];
            return json_encode($data, JSON_UNESCAPED_UNICODE);
        }
    }

    public function delete($uriArray) // DELETE contract : 계약서 삭제
    {
        $contractDAO = new contractDAO();

        if (!empty($uriArray[2])) { // 파라미터 유효성 검사

            $result = $contractDAO->delete($uriArray[2]);

            if (!empty($result)) { //정상적으로 delete
                $data = ["result" => true];

                return json_encode($data);
            } else { // 잘못된 파라미터 값
                $data = ["result" => false,
                    "errorMessage" => "id is Not Found"]; //존재하지 않는 id

                return json_encode($data);
            }
        } else { //파라미터값 is null
            $data = ["result" => false,
                "errorMessage" => "parameter is null"]; //삭제할 유저 id값이 안넘어왔을 때

            return json_encode($data);

        }
    }

}

?>

