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
    private $user_id;

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
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    /**
     * @param int|null $user_id
     */
    public function setUserId(?int $user_id): void
    {
        $this->user_id = $user_id;
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
?>
