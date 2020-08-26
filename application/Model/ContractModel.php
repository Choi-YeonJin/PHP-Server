<?php
namespace Model;
include_once("application/lib/autoload.php");

class ContractModel extends BaseModel
{
    /**
     * @var string
     */
    private $title;

    /**
     * @var string
     */
    private $borrowDate;

    /**
     * @var string
     */
    private $paybackDate;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $userId;

    /**
     * @var string
     */
    private $userName;

    /**
     * @var string
     */
    private $alarm;

    /**
     * @var state
     */
    private $state;

    /**
     * @var int
     */
    private $createdAt;


    /**
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle(?string $title): void
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBorrowDate(): ?string
    {
        return $this->borrowDate;
    }

    /**
     * @param string $borrowDate
     */
    public function setBorrowDate(?string $borrowDate): void
    {
        $this->borrowDate = $borrowDate;
    }

    /**
     * @return string
     */
    public function getPaybackDate(): ?string
    {
        return $this->paybackDate;
    }

    /**
     * @param string $paybackDate
     */
    public function setPaybackDate(?string $paybackDate): void
    {
        $this->paybackDate = $paybackDate;
    }

    /**
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
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
     * @return string
     */
    public function getAlarm(): ?string
    {
        return $this->alarm;
    }

    /**
     * @param string $alarm
     */
    public function setAlarm(?string $alarm): void
    {
        $this->alarm = $alarm;
    }

    /**
     * @return state
     */
    public function getState(): ?string
    {
        return $this->state;
    }

    /**
     * @param state $state
     */
    public function setState(?string $state): void
    {
        $this->state = $state;
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