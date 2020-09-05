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

}

?>