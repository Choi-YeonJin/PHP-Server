<?php
namespace Model;
include_once("../../application/lib/autoload.php");

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
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return string
     */
    public function getBorrowDate()
    {
        return $this->borrow_date;
    }

    /**
     * @param string $borrow_date
     */
    public function setBorrowDate($borrow_date)
    {
        $this->borrow_date = $borrow_date;
    }

    /**
     * @return string
     */
    public function getPaybackDate()
    {
        return $this->payback_date;
    }

    /**
     * @param string $payback_date
     */
    public function setPaybackDate($payback_date)
    {
        $this->payback_date = $payback_date;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getLenderId()
    {
        return $this->lender_id;
    }

    /**
     * @param int $lender_id
     */
    public function setLenderId($lender_id)
    {
        $this->lender_id = $lender_id;
    }

    /**
     * @return string
     */
    public function getLenderName()
    {
        return $this->lender_name;
    }

    /**
     * @param string $lender_name
     */
    public function setLenderName($lender_name)
    {
        $this->lender_name = $lender_name;
    }

    /**
     * @return string
     */
    public function getPenalty()
    {
        return $this->penalty;
    }

    /**
     * @param string $penalty
     */
    public function setPenalty($penalty)
    {
        $this->penalty = $penalty;
    }

    /**
     * @return int
     */
    public function getAlarm()
    {
        return $this->alarm;
    }

    /**
     * @param int $alarm
     */
    public function setAlarm($alarm)
    {
        $this->alarm = $alarm;
    }

    /**
     * @return int
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param int $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * @return int
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * @param int $created_at
     */
    public function setCreatedAt($created_at)
    {
        $this->created_at = $created_at;
    }

    /**
     * @return int
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * @param int $updated_at
     */
    public function setUpdatedAt($updated_at)
    {
        $this->updated_at = $updated_at;
    }


}