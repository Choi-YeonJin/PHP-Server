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
    private $requestTime;

    /**
     * @var int
     */
    private $applicantId;

    /**
     * @var string
     */
    private $applicantName;

    /**
     * @var int
     */
    private $recipientId;

    /**
     * @var string
     */
    private $recipientName;

    /**
     * @var int
     */
    private $acceptState;

    /**
     * @var int
     */
    private $acceptTime;

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
    public function getRequestTime(): ?int
    {
        return $this->requestTime;
    }

    /**
     * @param int $requestTime
     */
    public function setRequestTime(?int $requestTime): void
    {
        $this->requestTime = $requestTime;
    }

    /**
     * @return int
     */
    public function getApplicantId(): ?int
    {
        return $this->applicantId;
    }

    /**
     * @param int|null $applicantId
     */
    public function setApplicantId(?int $applicantId): void
    {
        $this->applicantId = $applicantId;
    }

    /**
     * @return string
     */
    public function getApplicantName(): ?string
    {
        return $this->applicantName;
    }

    /**
     * @param string|null $applicantName
     */
    public function setApplicantName(?string $applicantName): void
    {
        $this->applicantName = $applicantName;
    }

    /**
     * @return int
     */
    public function getRecipientId(): ?int
    {
        return $this->recipientId;
    }

    /**
     * @param int|null $recipientId
     */
    public function setRecipientId(?int $recipientId): void
    {
        $this->recipientId = $recipientId;
    }

    /**
     * @return string
     */
    public function getRecipientName(): ?string
    {
        return $this->recipientName;
    }

    /**
     * @param string|null $recipientName
     */
    public function setRecipientName(?string $recipientName): void
    {
        $this->recipientName = $recipientName;
    }

    /**
     * @return int
     */
    public function getAcceptState(): ?int
    {
        return $this->acceptState;
    }

    /**
     * @param int $acceptState
     */
    public function setAcceptState(?int $acceptState): void
    {
        $this->acceptState = $acceptState;
    }

    /**
     * @return int
     */
    public function getAcceptTime(): ?int
    {
        return $this->acceptTime;
    }

    /**
     * @param int|null $acceptTime
     */
    public function setAcceptTime(?int $acceptTime): void
    {
        $this->acceptTime = $acceptTime;
    }

}
?>