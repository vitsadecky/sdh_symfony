<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\User;
use App\Event\UserEvent;

/**
 * Class UserEventFactory
 * @package App\Event\Factory
 */
class UserEventFactory
{
    /**
     * @param User $user
     * @return UserEvent
     */
    public function create(User $user): UserEvent
    {
        return new UserEvent($user);
    }
}