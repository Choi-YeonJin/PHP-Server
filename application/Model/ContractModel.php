<?php
namespace Model;
include_once("../application/lib/autoload.php");

class ContractModel extends BaseModel
{
    /**
     * @var int
     */
    private $id;

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
    private $lenderId;

    /**
     * @var string
     */
    private $lenderName;

    /**
     * @var string
     */
    private $lenderBank;

    /**
     * @var int
     */
    private $lenderAccount;

    /**
     * @var string
     */
    private $penalty;

    /**
     * @var string
     */
    private $content;

    /**
     * @var int
     */
    private $alarm;

    /**
     * @var int
     */
    private $state;

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
     * @return string
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string|null $title
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
     * @param string|null $borrowDate
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
     * @param string|null $paybackDate
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
     * @param int|null $price
     */
    public function setPrice(?int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getLenderId(): ?int
    {
        return $this->lenderId;
    }

    /**
     * @param int|null $lenderId
     */
    public function setLenderId(?int $lenderId): void
    {
        $this->lenderId = $lenderId;
    }

    /**
     * @return string
     */
    public function getLenderName(): ?string
    {
        return $this->lenderName;
    }

    /**
     * @param string|null $lenderName
     */
    public function setLenderName(?string $lenderName): void
    {
        $this->lenderName = $lenderName;
    }

    /**
     * @return string
     */
    public function getLenderBank(): ?string
    {
        return $this->lenderBank;
    }

    /**
     * @param string|null $lenderBank
     */
    public function setLenderBank(?string $lenderBank): void
    {
        $this->lenderBank = $lenderBank;
    }

    /**
     * @return int
     */
    public function getLenderAccount(): ?int
    {
        return $this->lenderAccount;
    }

    /**
     * @param int|null $lenderAccount
     */
    public function setLenderAccount(?int $lenderAccount): void
    {
        $this->lenderAccount = $lenderAccount;
    }

    /**
     * @return string
     */
    public function getPenalty(): ?string
    {
        return $this->penalty;
    }

    /**
     * @param string|null $penalty
     */
    public function setPenalty(?string $penalty): void
    {
        $this->penalty = $penalty;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(?string $content): void
    {
        $this->content = $content;
    }

    /**
     * @return int
     */
    public function getAlarm(): ?int
    {
        return $this->alarm;
    }

    /**
     * @param int|null $alarm
     */
    public function setAlarm(?int $alarm): void
    {
        $this->alarm = $alarm;
    }

    /**
     * @return int
     */
    public function getState(): ?int
    {
        return $this->state;
    }

    /**
     * @param int|null $state
     */
    public function setState(?int $state): void
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