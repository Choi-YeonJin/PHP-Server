<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * user 테이블 Model
 */

namespace Model;
include_once("../../application/lib/autoload.php");

class UserModel extends BaseModel {

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $myid;

    /**
     * @var string
     */
    private $password;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $imageUrl;

    /**
     * @var string
     */
    private $phoneNum;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getMyid(): ?string
    {
        return $this->myid;
    }

    /**
     * @param string $myid
     */
    public function setMyid(?string $myid): void
    {
        $this->myid = $myid;
    }

    /**
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(?string $password): void
    {
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(?string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getImageUrl(): ?string
    {
        return $this->imageUrl;
    }

    /**
     * @param string $imageUrl
     */
    public function setImageUrl(?string $imageUrl): void
    {
        $this->imageUrl = $imageUrl;
    }

    /**
     * @return string
     */
    public function getPhoneNum(): ?string
    {
        return $this->phoneNum;
    }

    /**
     * @param string $phoneNum
     */
    public function setPhoneNum(?string $phoneNum): void
    {
        $this->phoneNum = $phoneNum;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    /**
     * @param int $createdAt
     */
    public function setCreatedAt(?int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }



    public function updateModel(UserModel $userModel){
        $updateCount = 0;
        if(strcmp($this->name, $userModel->getName()) !== 0){
            $updateCount++;
            $this->setName($userModel->getName());
        }
    }







}