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
        $query = "INSERT INTO {$this->tableName} (
                    title,
                    borrowDate,
                    paybackDate,
                    price,
                    userId,
                    userName,
                    penalty,
                    alarm,
                    createdAt
                    ) VALUES (
                    '{$contractModel->getTitle()}',
                    '{$contractModel->getBorrowDate()}',
                    '{$contractModel->getPaybackDate()}',
                    {$contractModel->getPrice()},
                    {$contractModel->getUserId()},
                    '{$contractModel->getUserName()}'
                    '{$contractModel->getPenalty()}'
                    {$contractModel->getAlarm()},
                    {$contractModel->getCreatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @param $name
     * @return ContractModel
     */
    public function selectuserName($name){
        $query = "SELECT * FROM {$this->tableName} WHERE userName like {$name}";
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