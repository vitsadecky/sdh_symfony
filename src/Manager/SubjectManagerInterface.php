<?php declare(strict_types=1);
/**
 * Subject: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */

namespace App\Manager;

use App\Entity\Subject;

/**
 * Interface SubjectManagerInterface
 * @package App\Manager
 */
interface SubjectManagerInterface extends ManagerInterface
{
    /**
     * @param Subject $Subject
     * @param bool $validation
     * @return SubjectManager
     */
    public function createSubject(Subject $Subject, bool $validation = true): SubjectManagerInterface;

    /**
     * @param Subject $Subject
     * @param bool $validation
     * @return SubjectManager
     */
    public function editSubject(Subject $Subject, bool $validation = true): SubjectManagerInterface;

    /**
     * @param Subject $Subject
     * @return SubjectManager
     */
    public function deleteSubject(Subject $Subject): SubjectManagerInterface;

    /**
     * @return Subject[]
     */
    public function getAllSubjects(): array;
}