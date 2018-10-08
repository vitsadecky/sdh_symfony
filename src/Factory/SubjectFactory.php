<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Subject;

/**
 * Class SubjectFactory
 * @package App\Factory
 */
class SubjectFactory
{
    /**
     * @param string $code
     * @return Subject
     */
    public function create(string $code): Subject
    {
        $subject = new Subject();
        $subject->setCode($code);

        return $subject;
    }
}
