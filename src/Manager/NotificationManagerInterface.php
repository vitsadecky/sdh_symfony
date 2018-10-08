<?php declare(strict_types=1);
/**
 * Subject: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Notification;

/**
 * Interface NotificationManagerInterface
 * @package App\Manager
 */
interface NotificationManagerInterface
{
    /**
     * @param Notification $notification
     * @return NotificationManagerInterface
     */
    public function notify(Notification $notification): NotificationManagerInterface;
}