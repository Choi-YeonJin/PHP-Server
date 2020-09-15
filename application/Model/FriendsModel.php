<?php

namespace Model;
include_once("../application/lib/autoload.php");

class FriendsModel extends BaseModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var int
     */
    private $friendsId;

    /**
     * @var int
     */
    private $favorite;

    /**
     * @var int
     */
    private $block;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @var int
     */
    private $updatedAt;

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
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int|null $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return int
     */
    public function getFriendsId(): ?int
    {
        return $this->friendsId;
    }

    /**
     * @param int|null $friendsId
     */
    public function setFriendsId(?int $friendsId): void
    {
        $this->friendsId = $friendsId;
    }

    /**
     * @return int
     */
    public function getFavorite(): ?int
    {
        return $this->favorite;
    }

    /**
     * @param int|null $favorite
     */
    public function setFavorite(?int $favorite): void
    {
        $this->favorite = $favorite;
    }

    /**
     * @return int
     */
    public function getBlock(): ?int
    {
        return $this->block;
    }

    /**
     * @param int|null $block
     */
    public function setBlock(?int $block): void
    {
        $this->block = $block;
    }

    /**
     * @return int
     */
    public function getCreatedAt(): ?int
    {
        return $this->createdAt;
    }

    /**
     * @param int|null $createdAt
     */
    public function setCreatedAt(?int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    /**
     * @return int
     */
    public function getUpdatedAt(): ?int
    {
        return $this->updatedAt;
    }

    /**
     * @param int|null $updatedAt
     */
    public function setUpdatedAt(?int $updatedAt): void
    {
        $this->updatedAt = $updatedAt;
    }
}
?>
