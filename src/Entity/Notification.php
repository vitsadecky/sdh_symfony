<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Entity;

/**
 * Class Notification
 * @package App\Entity
 */
class Notification implements EntityInterface
{
    /** @var string|null */
    private $senderName;

    /** @var string|null */
    private $senderEmail;

    /** @var array * */
    private $recipients;

    /** @var string|null */
    private $subject;

    /** @var string|null */
    private $body;

    /**
     * Notification constructor.
     * @param null|string $subject
     * @param null|string $body
     * @param array|null $recipients
     */
    public function __construct(?string $subject = null, ?string $body = null, array $recipients = null)
    {
        $this->subject = $subject;
        $this->body = $body;
        $this->recipients = $recipients;
    }

    /**
     * @return null|string
     */
    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    /**
     * @param null|string $senderName
     * @return Notification
     */
    public function setSenderName(?string $senderName): Notification
    {
        $this->senderName = $senderName;
        return $this;
    }

    /**
     * @return null|string
     */
    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }

    /**
     * @param null|string $senderEmail
     * @return Notification
     */
    public function setSenderEmail(?string $senderEmail): Notification
    {
        $this->senderEmail = $senderEmail;
        return $this;
    }

    /**
     * @return array
     */
    public function getRecipients(): array
    {
        return $this->recipients ?? [];
    }

    /**
     * @param string $recipientEmail
     * @return Notification
     */
    public function setRecipients(string $recipientEmail): Notification
    {
        $this->recipients[] = $recipientEmail;
        return $this;
    }

    /**
     * @return string
     */
    public function getSubject(): ?string
    {
        return $this->subject;
    }

    /**
     * @param string|null $subject
     * @return Notification
     */
    public function setSubject(?string $subject): Notification
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getBody(): ?string
    {
        return $this->body;
    }

    /**
     * @param string|null $body
     * @return Notification
     */
    public function setBody(?string $body): Notification
    {
        $this->body = $body;
        return $this;
    }


}
