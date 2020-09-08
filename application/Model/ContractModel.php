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
    private $borrow_date;

    /**
     * @var string
     */
    private $payback_date;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $lender_id;

    /**
     * @var string
     */
    private $lender_name;

    /**
     * @var string
     */
    private $lender_bank;

    /**
     * @var int
     */
    private $lender_account;

    /**
     * @var string
     */
    private $penalty;

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
        return $this->borrow_date;
    }

    /**
     * @param string|null $borrow_date
     */
    public function setBorrowDate(?string $borrow_date): void
    {
        $this->borrow_date = $borrow_date;
    }

    /**
     * @return string
     */
    public function getPaybackDate(): ?string
    {
        return $this->payback_date;
    }

    /**
     * @param string|null $payback_date
     */
    public function setPaybackDate(?string $payback_date): void
    {
        $this->payback_date = $payback_date;
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
        return $this->lender_id;
    }

    /**
     * @param int|null $lender_id
     */
    public function setLenderId(?int $lender_id): void
    {
        $this->lender_id = $lender_id;
    }

    /**
     * @return string
     */
    public function getLenderName(): ?string
    {
        return $this->lender_name;
    }

    /**
     * @param string|null $lender_name
     */
    public function setLenderName(?string $lender_name): void
    {
        $this->lender_name = $lender_name;
    }

    /**
     * @return string
     */
    public function getLenderBank(): ?string
    {
        return $this->lender_bank;
    }

    /**
     * @param string|null $lender_bank
     */
    public function setLenderBank(?string $lender_bank): void
    {
        $this->lender_bank = $lender_bank;
    }

    /**
     * @return int
     */
    public function getLenderAccount(): ?int
    {
        return $this->lender_account;
    }

    /**
     * @param int|null $lender_account
     */
    public function setLenderAccount(?int $lender_account): void
    {
        $this->lender_account = $lender_account;
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