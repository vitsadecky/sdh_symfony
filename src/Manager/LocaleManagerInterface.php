<?php declare(strict_types=1);
/**
 * Subject: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

/**
 * Interface LocaleManagerInterface
 * @package App\Manager
 */
interface LocaleManagerInterface
{
    /**
     * @return array
     */
    public function getLocales(): array;
}