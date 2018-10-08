<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\Category;
use App\Event\CategoryEvent;

/**
 * Class CategoryEventFactory
 * @package App\Event\Factory
 */
class CategoryEventFactory
{
    /**
     * @param Category $category
     * @return CategoryEvent
     */
    public function create(Category $category): CategoryEvent
    {
        return new CategoryEvent($category);
    }
}