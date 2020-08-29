<?php
namespace Model;
include_once("application/lib/autoload.php");

class BorrowerModel extends BaseModel
{
    /**
     * @var int
     */
    private $contractId;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var int
     */
    private $paybackState;

    /**
     * @var int
     */
    private $createdAt;

    /**
     * @return int
     */
    public function getContractId(): ?int
    {
        return $this->contractId;
    }

    /**
     * @param int $contractId
     */
    public function setContractId(?int $contractId): void
    {
        $this->contractId = $contractId;
    }

    /**
     * @return int
     */
    public function getUserId(): ?int
    {
        return $this->userId;
    }

    /**
     * @param int $userId
     */
    public function setUserId(?int $userId): void
    {
        $this->userId = $userId;
    }

    /**
     * @return string
     */
    public function getUserName(): ?string
    {
        return $this->userName;
    }

    /**
     * @param string $userName
     */
    public function setUserName(?string $userName): void
    {
        $this->userName = $userName;
    }

    /**
     * @return int
     */
    public function getPaybackState(): ?int
    {
        return $this->paybackState;
    }

    /**
     * @param int $paybackState
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
     * @param int $createdAt
     */
    public function setCreatedAt(?int $createdAt): void
    {
        $this->createdAt = $createdAt;
    }




}