<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * UserModel - DAO
 */

namespace DAO;
use Model\UserModel;

include_once("../../../application/lib/autoload.php");

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
                    created_at,
                    updated_at 
                    ) VALUES (
                    '{$userModel->getMyid()}',
                    '{$userModel->getPassword()}',
                    '{$userModel->getName()}',
                    '{$userModel->getImageUrl()}',
                    '{$userModel->getPhoneNum()}',
                    {$userModel->getCreatedAt()},
                    {$userModel->getUpdatedAt()})";

        $this->db->executeQuery($query);
        return $this->db->getInsertId();
    }

    /**
     * @param $id string
     * @return UserModel
     */
    public function selectmyidByID($id){ //회원가입 중복검사
        $query = "SELECT * FROM {$this->tableName} WHERE myid like '{$id}'";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

    /**
     * @param $id string
     * @return UserModel
     */
    public function selectbyId($id){ // select
        $query = "SELECT * FROM {$this->tableName} WHERE id like '{$id}'";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new UserModel());
    }

    /**
     * @param $id
     * @return UserModel
     */
    public function select($myid,$password){ //login
        $query = "SELECT * FROM {$this->tableName} WHERE myid = '{$myid}' and password = '{$password}'";
        $this->db->executeQuery($query);
        return $this->db->getResultAsObject(new UserModel());
    }

    /**
     * @return UserModel[]
     */
    public function selectAll(){
        $query = "SELECT * FROM {$this->tableName}";
        $this->db->executeQuery($query);
        return $this->db->getAllResultAsObject(new UserModel());
    }

    /**
     * @return UserModel[]
     */
    public function updateUserInfo($id,$name,$password){
        $query = "UPDATE {$this->tableName} SET name='{$name}', password='{$password}' where id={$id}";
        $this->db->executeQuery($query);
        return $this->stmt->rowCount();
    }

}