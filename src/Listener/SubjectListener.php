<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:58
 */

namespace App\Listener;

use App\Event\SubjectEvent;


/**
 * Class SubjectListener
 * @package App\Listener
 */
class SubjectListener
{
    /**
     * @param SubjectEvent $event
     * @return SubjectListener
     */
    public function onSubjectCreatePre(SubjectEvent $event): ?SubjectListener
    {
        // TODO: Implement onCreatePre() method.
        return $this;
    }

    /**
     * @param SubjectEvent $event
     * @return SubjectListener
     */
    public function onSubjectCreatePost(SubjectEvent $event): SubjectListener
    {
        // TODO: Implement onCreatePost() method.
        return $this;
    }

    /**
     * @param SubjectEvent $event
     * @return SubjectListener
     */
    public function onSubjectEditPre(SubjectEvent $event): SubjectListener
    {
        // TODO: Implement onEditPre() method.
        return $this;
    }

    /**
     * @param SubjectEvent $event
     * @return SubjectListener
     */
    public function onSubjectEditPost(SubjectEvent $event): SubjectListener
    {
        // TODO: Implement onEditPost() method.
        return $this;
    }

    /**
     * @param SubjectEvent $event
     * @return SubjectListener
     */
    public function onSubjectDeletePre(SubjectEvent $event): SubjectListener
    {
        // TODO: Implement onDeletePre() method.
        return $this;
    }

    /**
     * @param SubjectEvent $event
     * @return SubjectListener
     */
    public function onSubjectDeletePost(SubjectEvent $event): SubjectListener
    {
        // TODO: Implement onDeletePost() method.
        return $this;
    }
}
