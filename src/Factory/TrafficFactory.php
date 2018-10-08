<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Traffic;

/**
 * Class TrafficFactory
 * @package App\Factory
 */
class TrafficFactory
{
    /**
     * @return Traffic
     */
    public function create(): Traffic
    {
        $traffic = new Traffic();
        $traffic->setAttendance(0);

        return $traffic;
    }
}
