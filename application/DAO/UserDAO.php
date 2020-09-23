<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * UserModel - DAO
 */

namespace DAO;
use http\Client\Curl\User;
use Model\UserModel;

include_once("../application/lib/autoload.php");

class UserDAO extends BaseDAO
{
    protected $tableName = "user";

    /**
     * @param UserModel $userModel
     * @return false|int|null
     */
    public function insert(UserModel $userModel){
        $query = "INSERT INTO {$this->tableName} (
                    myid,
                    password,
                    name,
                    image_url,
                    phone_num,
                    created_at
                    ) VALUES (
                    '{$userModel->getMyid()}',
                    '{$userModel->getPassword()}',
                    '{$userModel->getName()}',
                    '{$userModel->getImageUrl()}',
                    '{$userModel->getPhoneNum()}',
                    {$userModel->getCreatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @param $id int
     * @return UserModel
     */
    public function selectByMyid ($id){ //회원가입 중복검사
        $query = "SELECT * FROM {$this->tableName} WHERE myid like '{$id}'";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new UserModel());
    }

    /**
     * @param $id int
     * @return UserModel
     */
    public function selectbyId($id){ // 개인 회원 조회
        $query = "SELECT * FROM {$this->tableName} WHERE id like '{$id}'";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new UserModel());
    }

    /**
     * @param $myid string
     * @param $password string
     * @return UserModel
     */
    public function selectByMyIDAndPassword($myid,$password){ //login
        $query = "SELECT * FROM {$this->tableName} WHERE myid = '{$myid}' and password = '{$password}'";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new UserModel());
    }

    /**
     * @return UserModel[]
     */
    public function selectAll()
    {
        $query = "SELECT * FROM {$this->tableName}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new UserModel());
    }

    /**
     * @param $userModel UserModel
     * @return UserModel[]
     */
    public function selectbyUserName($userModel){
        $query = "SELECT * FROM {$this->tableName} where name = '{$userModel->getName()}'";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new UserModel());
    }

    /**
     * @param $id int
     * @param UserModel $userModel
     * @return int|null
     */
    public function update($id,UserModel $userModel){
        $query = "UPDATE {$this->tableName} SET image_url='{$userModel->getImageUrl()}', password='{$userModel->getPassword()}' where id={$id}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

    /**
     * @param $id int
     * @param UserModel $userModel
     * @return int|null
     */
    public function updatePw($id,UserModel $userModel){
        $query = "UPDATE {$this->tableName} SET password='{$userModel->getPassword()}' where id={$id}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

    /**
     * @param $id int
     * @param UserModel $userModel
     * @return false|int|null
     */
    public function updateBankAndAccount($id, UserModel $userModel){
        $query = "UPDATE {$this->tableName} SET bank='{$userModel->getBank()}', account={$userModel->getAccount()} where id={$id}";
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