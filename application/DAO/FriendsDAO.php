<?php

namespace DAO;
use Model\FriendsModel;

include_once("../application/lib/autoload.php");

class FriendsDAO extends BaseDAO
{
    protected $tableName = "friends";

    /**
     * @param FriendsModel $friendsModel
     * @return false|int|null
     */
    public function insert(FriendsModel $friendsModel)
    {
        $query = "INSERT INTO {$this->tableName} (
                    user_id,
                    friends_id,
                    created_at
                    ) VALUES (
                    {$friendsModel->getUserId()},
                    {$friendsModel->getFriendsId()},
                    {$friendsModel->getCreatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @return FriendsModel[]
     */
    public function selectbyUserId($userId){
        $query = "SELECT * FROM {$this->tableName} where user_id={$userId}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new FriendsModel());
    }

    /**
     * @return FriendsModel[]
     */
    public function selectFavoritebyUserId($userId){
        $query = "SELECT * FROM {$this->tableName} where user_id={$userId} AND favorite=1";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new FriendsModel());
    }

    /**
     * @return FriendsModel[]
     */
    public function selectBlockbyUserId($userId){
        $query = "SELECT * FROM {$this->tableName} where user_id={$userId} AND block=1";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new FriendsModel());
    }

    /**
     * @param $id int
     * @param FriendsModel $FriendsModel
     * @return false|int|null
     */
    public function updatedFavorite($id, FriendsModel $FriendsModel){
        $query = "UPDATE {$this->tableName} SET favorite={$FriendsModel->getFavorite()},block={$FriendsModel->getBlock()}, updated_at={$FriendsModel->getUpdatedAt()} 
                    where id={$id}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

    /**
     * @param $id int
     * @param FriendsModel $FriendsModel
     * @return false|int|null
     */
    public function updatedBlock($id, FriendsModel $FriendsModel){
        $query = "UPDATE {$this->tableName} SET block={$FriendsModel->getBlock()}, favorite={$FriendsModel->getFavorite()}, updated_at={$FriendsModel->getUpdatedAt()} 
                    where id={$id}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

    /**
     * @param FriendsModel $friendsModel
     * @return false|int|null
     */
    public function delete(FriendsModel $friendsModel){
        $query = "DELETE FROM {$this->tableName} where user_id={$friendsModel->getUserId()} AND friends_id={$friendsModel->getFriendsId()}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }
}
?>