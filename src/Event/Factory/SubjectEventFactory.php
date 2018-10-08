<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;


use App\Entity\Subject;
use App\Event\SubjectEvent;

/**
 * Class SubjectEventFactory
 * @package App\Event\Factory
 */
class SubjectEventFactory
{
    /**
     * @param Subject $subject
     * @return SubjectEvent
     */
    public function create(Subject $subject): SubjectEvent
    {
        return new SubjectEvent($subject);
    }
}