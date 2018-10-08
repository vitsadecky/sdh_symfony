<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:58
 */

namespace App\Listener;

use App\Event\UserEvent;

/**
 * Class UserListener
 * @package App\Listener
 */
class UserListener
{
    /**
     * @param UserEvent $event
     * @return UserListener
     */
    public function onUserCreatePre(UserEvent $event): UserListener
    {
        // TODO: Implement onCreatePre() method.
        return $this;
    }

    /**
     * @param UserEvent $event
     * @return UserListener
     */
    public function onUserCreatePost(UserEvent $event): UserListener
    {
        // TODO: Implement onCreatePost() method.
        return $this;
    }

    /**
     * @param UserEvent $event
     * @return UserListener
     */
    public function onUserEditPre(UserEvent $event): UserListener
    {
        // TODO: Implement onEditPre() method.
        return $this;
    }

    /**
     * @param UserEvent $event
     * @return UserListener
     */
    public function onUserEditPost(UserEvent $event): UserListener
    {
        // TODO: Implement onEditPost() method.
        return $this;
    }

    /**
     * @param UserEvent $event
     * @return UserListener
     */
    public function onUserDeletePre(UserEvent $event): UserListener
    {
        // TODO: Implement onDeletePre() method.
        return $this;
    }

    /**
     * @param UserEvent $event
     * @return UserListener
     */
    public function onUserDeletePost(UserEvent $event): UserListener
    {
        // TODO: Implement onDeletePost() method.
        return $this;
    }
}
