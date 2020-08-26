<?

namespace DAO;
use Model\ContractModel;

include_once("application/lib/autoload.php");

class ContractDAO extends BaseDAO
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
                    '{$ContractModel->getAlarm()}',
                    '{$ContractModel->getState()}'
                    {$ContractModel->getCreatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

}