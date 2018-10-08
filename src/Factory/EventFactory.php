<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Event;
use App\Entity\User;

/**
 * Class EventFactory
 * @package App\Factory
 */
class EventFactory
{
    /**
     * @param User $user
     * @return Event
     */
    public function create(User $user): Event
    {
        $event = new Event($user);
        $event->setCreatedAt(new \DateTime());

        return $event;
    }
}
