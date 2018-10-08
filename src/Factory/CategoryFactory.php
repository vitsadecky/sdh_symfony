<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Category;

/**
 * Class CategoryFactory
 * @package App\Entity
 */
class CategoryFactory
{
    /**
     * @return Category
     */
    public function create(): Category
    {
        return new Category();
    }
}
