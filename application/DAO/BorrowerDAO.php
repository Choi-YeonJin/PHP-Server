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
     * @param $contract_id
     * @return BorrowerModel
     */
    public function selectByContractId($contract_id){
        $query = "SELECT * FROM {$this->tableName} WHERE contract_id like {$contract_id}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new BorrowerModel());
    }

    /**
     * @param $user_id
     * @return BorrowerModel
     */
    public function selectByUserId($user_id){
        $query = "select * from {$this->tableName} where borrower_id={$user_id}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new BorrowerModel());
    }

    /**
     * @param $contract_id int
     * @return int|null
     */
    public function delete($contract_id){
        $query = "delete from {$this->tableName} where contract_id = {$contract_id}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

}

?>