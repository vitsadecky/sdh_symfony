<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 25. 9. 2018
 * Time: 8:46
 */

namespace App\Manager\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;
use Throwable;

/**
 * Class InvalidDataException
 * @package App\Manager\Exception
 */
class InvalidDataException extends \RuntimeException
{
    /** @var ConstraintViolationListInterface $violationList */
    private $violationList;

    public function __construct(ConstraintViolationListInterface $violationList, int $code = 0, Throwable $previous = null)
    {
        $this->violationList = $violationList;

        $errorMessage = '';
        foreach ( $this->violationList as $violation) {
            $errorMessage .= $violation."\n";
        }

        parent::__construct($errorMessage, $code, $previous);
    }

    /**
     * @return ConstraintViolationListInterface
     */
    public function getViolationList(): ConstraintViolationListInterface
    {
        return $this->violationList;
    }

}