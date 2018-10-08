<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:38
 */

namespace App\Event;

use App\Entity\Forum;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ForumEvent
 * @package App\Event
 */
class ForumEvent extends Event
{
    public const
        CREATE_PRE = self::EVENT_PREFIX . '.createPre',
        CREATE_POST = self::EVENT_PREFIX . '.createPost',
        EDIT_PRE = self::EVENT_PREFIX . '.editPre',
        EDIT_POST = self::EVENT_PREFIX . '.editPost',
        DELETE_PRE = self::EVENT_PREFIX . '.deletePre',
        DELETE_POST = self::EVENT_PREFIX . '.deletePost';

    private const EVENT_PREFIX = 'forum';


    /** @var Forum */
    private $forum;

    /**
     * UserEvent constructor.
     * @param Forum $forum
     */
    public function __construct(Forum $forum)
    {
        $this->forum = $forum;
    }

    /**
     * @return Forum
     */
    public function getForum(): Forum
    {
        return $this->forum;
    }
}