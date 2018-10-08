<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\Event;
use App\Event\EventEvent;

/**
 * Class EventEventFactory
 * @package App\Event\Factory
 */
class EventEventFactory
{
    /**
     * @param Event $event
     * @return EventEvent
     */
    public function create(Event $event): EventEvent
    {
        return new EventEvent($event);
    }
}