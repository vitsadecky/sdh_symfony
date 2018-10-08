<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\Sdh;
use App\Event\SdhEvent;

/**
 * Class SdhEventFactory
 * @package App\Event\Factory
 */
class SdhEventFactory
{
    /**
     * @param Sdh $sdh
     * @return SdhEvent
     */
    public function create(Sdh $sdh): SdhEvent
    {
        return new SdhEvent($sdh);
    }
}