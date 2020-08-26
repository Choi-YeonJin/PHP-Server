<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * user 테이블 Model
 */

namespace Model;
include_once("application/lib/autoload.php");

class UserModel extends BaseModel {
    /**s
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(?int $id): void
    {
        $this->id = $id;
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