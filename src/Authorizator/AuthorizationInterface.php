<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 3. 10. 2018
 * Time: 7:42
 */

namespace App\Authorizator;

/**
 * Interface ManagerInterface
 * @package App\Manager
 */
interface AuthorizationInterface
{
    /**
     * @return bool
     */
    public function canCreate(): bool;

    /**
     * @return bool
     */
    public function canView(): bool;

    /**
     * @return bool
     */
    public function canDelete(): bool;

}