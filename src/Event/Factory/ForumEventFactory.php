<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\Forum;
use App\Event\ForumEvent;

/**
 * Class ForumEventFactory
 * @package App\Event\Factory
 */
class ForumEventFactory
{
    /**
     * @param Forum $forum
     * @return ForumEvent
     */
    public function create(Forum $forum): ForumEvent
    {
        return new ForumEvent($forum);
    }
}