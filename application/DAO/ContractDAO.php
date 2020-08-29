<?php

namespace DAO;
use Model\ContractModel;

include_once("../../application/lib/autoload.php");

class ContractDAO extends BaseDAO
{
    protected $tableName = "contract";

    /**
     * @param ContractModel $contractModel
     * @return false|int|null
     */
    public function insert(ContractModel $contractModel){
        $penalty =  str_replace ("'", "\'", $contractModel->getPenalty());

        $query = "INSERT INTO {$this->tableName} (
                    title,
                    borrow_date,
                    payback_date,
                    price,
                    lender_id,
                    lender_name,
                    penalty,
                    alarm,
                    created_at,
                    updated_at
                    ) VALUES (
                    '{$contractModel->getTitle()}',
                    '{$contractModel->getBorrowDate()}',
                    '{$contractModel->getPaybackDate()}',
                    {$contractModel->getPrice()},
                    {$contractModel->getLenderId()},
                    '{$contractModel->getLenderName()}',
                    '{$penalty}',
                    {$contractModel->getAlarm()},
                    {$contractModel->getCreatedAt()},
                    {$contractModel->getUpdatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @param $name
     * @return ContractModel
     */
    public function selectlender($name){
        $query = "SELECT * FROM {$this->tableName} WHERE lender_name like '{$name}'";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new ContractModel());
    }

    /**
     * @param $name
     * @return ContractModel
     */
    public function selectId($id){
        $query = "SELECT * FROM {$this->tableName} WHERE id like {$id}";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new ContractModel());
    }

    /**
     * @return UserModel[]
     */
    public function selectAll(){
        $query = "SELECT * FROM {$this->tableName}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new ContractModel());
    }

}

?>