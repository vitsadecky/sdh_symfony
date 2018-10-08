<?php declare(strict_types=1);
/**
 * Sdh: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Sdh;

/**
 * Interface SdhManagerInterface
 * @package App\Manager
 */
interface SdhManagerInterface extends ManagerInterface
{
    /**
     * @param Sdh $Sdh
     * @return SdhManagerInterface
     */
    public function createSdh(Sdh $Sdh): SdhManagerInterface;

    /**
     * @param Sdh $sdh
     * @return SdhManagerInterface
     */
    public function editSdh(Sdh $sdh): SdhManagerInterface;

    /**
     * @param Sdh $sdh
     * @return SdhManagerInterface
     */
    public function deleteSdh(Sdh $sdh): SdhManagerInterface;

    /**
     * @param Sdh $sdh
     * @return SdhManagerInterface
     */
    public function getHistory(Sdh $sdh): SdhManagerInterface;

    /**
     * @param Sdh $sdh
     * @return mixed
     */
    public function editHistory(Sdh $sdh): SdhManagerInterface;
}