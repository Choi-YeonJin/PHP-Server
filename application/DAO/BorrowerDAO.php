<?

namespace DAO;
use Model\BorrowerModel;

include_once("application/lib/autoload.php");

class BorrowerDAO extends BaseDAO
{
    protected $tableName = "user";

//    param phonenumber
//
//
//
//    selectbyphonenumber

    /**
     * @param ContractModel $ConractModel
     * @return false|int|null
     */
    public function insert(ContractModel $ContractModel){
        $query = "INSERT INTO {$this->tableName} (
                    title,
                    borrowDate,
                    paybackDate,
                    price,
                    userId,
                    userName,
                    penalty,
                    alarm,
                    state,
                    createdAt
                    ) VALUES (
                    '{$ContractModel->getTitle()}',
                    '{$ContractModel->getBorrowDate()}',
                    '{$ContractModel->getPaybackDate()}',
                    '{$ContractModel->getPrice()}',
                    {$ContractModel->getUserId()},
                    '{$ContractModel->getUserName()}'
                    '{$ContractModel->getPenalty()}'
                    '{$ContractModel->getAlarm()}',
                    '{$ContractModel->getState()}'
                    {$ContractModel->getCreatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    public function selectbyMyid($name){
        $query = "SELECT * FROM {$this->tableName} WEHERE myid = '{$name}' or name='{$name}'";

        $this->db->executeQuery($query);
        return $this->db->getResultAsObject();
    }

}