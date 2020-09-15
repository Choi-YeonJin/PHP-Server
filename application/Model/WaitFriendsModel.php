<?php
namespace Model;
include_once("../application/lib/autoload.php");

class WaitFriendsModel extends BaseModel
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $add_time;

    /**
     * @var int
     */
    private $applicant_id;

    /**
     * @var string
     */
    private $applicant_name;

    /**
     * @var int
     */
    private $recipient_id;

    /**
     * @var string
     */
    private $recipient_name;

    /**
     * @var int
     */
    private $add_state;

    /**
     * @var int
     */
    private $accept_time;

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
    public function getAddTime(): ?int
    {
        return $this->add_time;
    }

    /**
     * @param int|null $add_time
     */
    public function setAddTime(?int $add_time): void
    {
        $this->add_time = $add_time;
    }

    /**
     * @return int
     */
    public function getApplicantId(): ?int
    {
        return $this->applicant_id;
    }

    /**
     * @param int|null $applicant_id
     */
    public function setApplicantId(?int $applicant_id): void
    {
        $this->applicant_id = $applicant_id;
    }

    /**
     * @return string
     */
    public function getApplicantName(): ?string
    {
        return $this->applicant_name;
    }

    /**
     * @param string|null $applicant_name
     */
    public function setApplicantName(?string $applicant_name): void
    {
        $this->applicant_name = $applicant_name;
    }

    /**
     * @return int
     */
    public function getRecipientId(): ?int
    {
        return $this->recipient_id;
    }

    /**
     * @param int|null $recipient_id
     */
    public function setRecipientId(?int $recipient_id): void
    {
        $this->recipient_id = $recipient_id;
    }

    /**
     * @return string
     */
    public function getRecipientName(): ?string
    {
        return $this->recipient_name;
    }

    /**
     * @param string|null $recipient_name
     */
    public function setRecipientName(?string $recipient_name): void
    {
        $this->recipient_name = $recipient_name;
    }

    /**
     * @return int
     */
    public function getAddState(): ?int
    {
        return $this->add_state;
    }

    /**
     * @param int|null $add_state
     */
    public function setAddState(?int $add_state): void
    {
        $this->add_state = $add_state;
    }

    /**
     * @return int
     */
    public function getAcceptTime(): ?int
    {
        return $this->accept_time;
    }

    /**
     * @param int|null $accept_time
     */
    public function setAcceptTime(?int $accept_time): void
    {
        $this->accept_time = $accept_time;
    }

}
?>