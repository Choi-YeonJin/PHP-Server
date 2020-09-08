<?php
/**
 * 2020/8/14
 * Copyright (c) ITKOO
 *
 * user 테이블 Model
 */

namespace Model;
include_once("../application/lib/autoload.php");

class  UserModel extends BaseModel {

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
    private $image_url;

    /**
     * @var string
     */
    private $phone_num;

    /**
     * @var string
     */
    private $bank;

    /**
     * @var int
     */
    private $account;

    /**
     * @var int
     */
    private $created_at;

    /**
     * @var int
     */
    private $updated_at;

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     */
    public function setId(?int $id): void
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
     * @param string|null $myid
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
     * @param string|null $password
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
     * @param string|null $name
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
        return $this->image_url;
    }

    /**
     * @param string|null $image_url
     */
    public function setImageUrl(?string $image_url): void
    {
        $this->image_url = $image_url;
    }

    /**
     * @return string
     */
    public function getPhoneNum(): ?string
    {
        return $this->phone_num;
    }

    /**
     * @param string|null $phone_num
     */
    public function setPhoneNum(?string $phone_num): void
    {
        $this->phone_num = $phone_num;
    }

    /**
     * @return string
     */
    public function getBank(): ?string
    {
        return $this->bank;
    }

    /**
     * @param string|null $bank
     */
    public function setBank(?string $bank): void
    {
        $this->bank = $bank;
    }

    /**
     * @return int
     */
    public function getAccount(): ?int
    {
        return $this->account;
    }

    /**
     * @param int|null $account
     */
    public function setAccount(?int $account): void
    {
        $this->account = $account;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): ?int
    {
        return $this->created_at;
    }

    /**
     * @param int|null $created_at
     */
    public function setCreatedAt(?int $created_at): void
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updated_at;
    }

    /**
     * @param int|null $updated_at
     */
    public function setUpdatedAt(?int $updated_at): void
    {
        $this->updated_at = $updated_at;
    }
}