<?php

namespace DAO;
use Model\BorrowerModel;

include_once("../application/lib/autoload.php");

class BorrowerDAO extends BaseDAO
{
    protected $tableName = "borrower";

    /**
     * @param BorrowerModel $borrowerModel
     * @return false|int|null
     */
    public function insert(BorrowerModel $borrowerModel){
        $query = "INSERT INTO {$this->tableName} (
                    contract_id,
                    borrower_id,
                    user_name,
                    price,
                    payback_state,
                    created_at
                    ) VALUES (
                    {$borrowerModel->getContractId()},
                    {$borrowerModel->getBorrowerId()},
                    '{$borrowerModel->getUserName()}',
                    {$borrowerModel->getPrice()},
                    {$borrowerModel->getPaybackState()},
                    {$borrowerModel->getCreatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @param BorrowerModel $borrowerModel
     * @return false|int|null
     */
    public function insertBycontractId(BorrowerModel $borrowerModel){
        $query = "INSERT INTO {$this->tableName} (
                    contract_id,
                    borrower_id,
                    user_name,
                    price,
                    payback_state,
                    updated_at
                    ) VALUES (
                    {$borrowerModel->getContractId()},
                    {$borrowerModel->getBorrowerId()},
                    '{$borrowerModel->getUserName()}',
                    {$borrowerModel->getPrice()},
                    {$borrowerModel->getPaybackState()},
                    {$borrowerModel->getUpdatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @param $contractId
     * @return BorrowerModel
     */
    public function selectByContractId($contractId){
        $query = "SELECT * FROM {$this->tableName} WHERE contract_id like {$contractId}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new BorrowerModel());
    }

    /**
     * @param $userId
     * @return BorrowerModel
     */
    public function selectByUserId($userId){
        $query = "select * from {$this->tableName} where borrower_id={$userId}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new BorrowerModel());
    }

    /**
     * @param $contractId int
     * @return int|null
     */
    public function delete($contractId){
        $query = "delete from {$this->tableName} where contract_id = {$contractId}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

}

?>