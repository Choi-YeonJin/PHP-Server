<?php
namespace DAO;
use Model\WaitFriendsModel;

include_once("../application/lib/autoload.php");

class WaitFriendsDAO extends BaseDAO
{
    protected $tableName = "wait_friends";

    /**
     * @param WaitFriendsModel $waitFriendsModel
     * @return false|int|null
     */
    public function insert(WaitFriendsModel $waitFriendsModel){
        $query = "INSERT INTO {$this->tableName} (
                    add_time,
                    applicant_id,
                    applicant_name,
                    recipient_id,
                    recipient_name,
                    add_state
                    ) VALUES (
                    {$waitFriendsModel->getAddTime()},
                    {$waitFriendsModel->getApplicantId()},
                    '{$waitFriendsModel->getApplicantName()}',
                    {$waitFriendsModel->getRecipientId()},
                    '{$waitFriendsModel->getRecipientName()}',
                    {$waitFriendsModel->getAddState()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @param $id int
     * @return WaitFriendsModel
     */
    public function selectbyId($id){ // select
        $query = "SELECT * FROM {$this->tableName} WHERE id like '{$id}'";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new WaitFriendsModel());
    }

    /**
     * @return WaitFriendsModel[]
     */
    public function selectRequestFriends($userId){
        $query = "SELECT * FROM {$this->tableName} where recipient_id={$userId} And accept_state= 0";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new WaitFriendsModel());
    }

    /**
     * @param WaitFriendsModel $waitFriendsModel
     * @return false|int|null
     */
    public function updateAcceptTime(WaitFriendsModel $waitFriendsModel){
        $query = "UPDATE {$this->tableName} SET add_state={$waitFriendsModel->getAddState()}, accept_time={$waitFriendsModel->getAcceptTime()} 
                    where id={$waitFriendsModel->getId()}";

        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

    /**
     * @param $id int
     * @return int|null
     */
    public function delete($id){
        $query = "delete from {$this->tableName} where id = {$id};";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

}
?>