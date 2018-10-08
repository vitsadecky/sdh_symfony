<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Address;

/**
 * Class AddressFactory
 * @package App\Factory
 */
class AddressFactory
{
    /**
     * @return Address
     */
    public function create(): Address
    {
        return new Address();
    }
}
