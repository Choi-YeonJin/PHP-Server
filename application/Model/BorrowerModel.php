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
    private $contract_id;

    /**
     * @var int
     */
    private $borrower_id;

    /**
     * @var string
     */
    private $user_name;

    /**
     * @var int
     */
    private $price;

    /**
     * @var int
     */
    private $payback_state;

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
    public function getContractId(): ?int
    {
        return $this->contract_id;
    }

    /**
     * @param int|null $contract_id
     */
    public function setContractId(?int $contract_id): void
    {
        $this->contract_id = $contract_id;
    }

    /**
     * @return int
     */
    public function getBorrowerId(): ?int
    {
        return $this->borrower_id;
    }

    /**
     * @param int|null $borrower_id
     */
    public function setBorrowerId(?int $borrower_id): void
    {
        $this->borrower_id = $borrower_id;
    }

    /**
     * @return string
     */
    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    /**
     * @param string|null $user_name
     */
    public function setUserName(?string $user_name): void
    {
        $this->user_name = $user_name;
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
        return $this->payback_state;
    }

    /**
     * @param int|null $payback_state
     */
    public function setPaybackState(?int $payback_state): void
    {
        $this->payback_state = $payback_state;
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