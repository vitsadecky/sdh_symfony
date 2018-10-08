<?php declare(strict_types=1);
/**
 * Article: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Event;

/**
 * Interface CategoryManagerInterface
 * @package App\Manager
 */
interface EventManagerInterface extends ManagerInterface
{
    /**
     * @param Event $event
     * @param bool $validation
     * @return EventManagerInterface
     */
    public function createEvent(Event $event, bool $validation = true): EventManagerInterface;

    /**
     * @param Event $event
     * @param bool $validation
     * @return EventManagerInterface
     */
    public function editEvent(Event $event, bool $validation = true): EventManagerInterface;

    /**
     * @param Event $event
     * @return EventManagerInterface
     */
    public function deleteEvent(Event $event): EventManagerInterface;

    /**
     * @return Event[]
     */
    public function getAllEvents(): array;
}