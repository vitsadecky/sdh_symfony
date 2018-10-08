<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:38
 */

namespace App\Event;

use App\Entity\Subject;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class SubjectEvent
 * @package App\Event
 */
class SubjectEvent extends Event
{
    public const
        CREATE_PRE = self::EVENT_PREFIX . '.createPre',
        CREATE_POST = self::EVENT_PREFIX . '.createPost',
        EDIT_PRE = self::EVENT_PREFIX . '.editPre',
        EDIT_POST = self::EVENT_PREFIX . '.editPost',
        DELETE_PRE = self::EVENT_PREFIX . '.deletePre',
        DELETE_POST = self::EVENT_PREFIX . '.deletePost';

    private const EVENT_PREFIX = 'subject';

    /** @var Subject */
    private $subject;

    /**
     * UserEvent constructor.
     * @param Subject $subject
     */
    public function __construct(Subject $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }
}
