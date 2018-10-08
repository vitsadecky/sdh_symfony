<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;


namespace App\Factory;

use App\Entity\Notification;

/**
 * Class NotificationFactory
 * @package App\Factory
 */
class NotificationFactory
{
    /**
     * @param null|string $subject
     * @param null|string $body
     * @return Notification
     */
    public function create(?string $subject = null, ?string $body = null): Notification
    {
        return new Notification($subject, $body);
    }
}
