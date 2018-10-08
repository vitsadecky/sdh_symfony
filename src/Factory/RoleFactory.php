<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Role;

/**
 * Class RoleFactory
 * @package App\Factory
 */
class RoleFactory
{
    /**
     * @return Role
     */
    public function create(): Role
    {
        return new Role();
    }
}
