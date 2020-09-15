<?php
namespace Model;
include_once("../application/lib/autoload.php");

class BorrowerModel extends BaseModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $contractId;

    /**
     * @var int
     */
    private $borrowerId;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $paybackState;

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
    public function getContractId(): ?int
    {
        return $this->contractId;
    }

    /**
     * @param int|null $contractId
     */
    public function setContractId(?int $contractId): void
    {
        $this->contractId = $contractId;
    }

    /**
     * @return int
     */
    public function getBorrowerId(): ?int
    {
        return $this->borrowerId;
    }

    /**
     * @param int|null $borrowerId
     */
    public function setBorrowerId(?int $borrowerId): void
    {
        $this->borrowerId = $borrowerId;
    }

    /**
     * @return string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string|null $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int|null $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getPaybackState(): ?int
    {
        return $this->paybackState;
    }

    /**
     * @param int|null $paybackState
     */
    public function setPaybackState(?int $paybackState): void
    {
        $this->paybackState = $paybackState;
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