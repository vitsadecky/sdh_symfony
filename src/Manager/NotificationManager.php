<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Manager;

use App\Entity\Notification;
use App\Factory\MessageFactory;
use App\Manager\Exception\NotificationException;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

/**
 * Class NotificationManager
 * @package App\Manager
 */
class NotificationManager implements NotificationManagerInterface
{
    /** @var \Swift_Mailer */
    private $mailer;

    /** @var ParameterBagInterface */
    private $parameterBag;

    /** @var MessageFactory */
    private $messageFactory;

    /**
     * NotificationManager constructor.
     * @param ParameterBagInterface $parameterBag
     * @param \Swift_Mailer $mailer
     * @param MessageFactory $messageFactory
     */
    public function __construct(ParameterBagInterface $parameterBag, \Swift_Mailer $mailer, MessageFactory $messageFactory)
    {
        $this->mailer = $mailer;
        $this->parameterBag = $parameterBag;
        $this->messageFactory = $messageFactory;
    }

    /**
     * @return \Swift_Mailer
     */
    public function getMailer(): \Swift_Mailer
    {
        return $this->mailer;
    }

    /**
     * @param Notification $notification
     * @return NotificationManagerInterface
     */
    public function notify(Notification $notification): NotificationManagerInterface
    {
        $failedRecipients = [];
        $this->mailer->send($this->createMessage($notification), $failedRecipients);
        if(\count($failedRecipients) > 0) {
            throw new NotificationException(
                sprintf('User notification: %s', implode($failedRecipients, ','))
            );
        }

        return $this;
    }

    /**
     * @param Notification $notification
     * @return \Swift_Message
     */
    protected function createMessage(Notification $notification): \Swift_Message
    {
        $recipients = $this->parameterBag->get('sdh.notification.recipients');
        if(\count($recipients) === 0) {
            throw  new NotificationException('Invalid configuration, notification recipient email is missing!');
        }

        $message = $this->messageFactory->create($notification->getSubject(), $notification->getBody());
        $message->setReadReceiptTo($recipients)->setSender(
            $notification->getSenderName(),
            $notification->getSenderEmail());

        return $message;
    }
}
