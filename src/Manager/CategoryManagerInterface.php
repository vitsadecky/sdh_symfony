<?php declare(strict_types=1);
/**
 * Article: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Category;

/**
 * Interface CategoryManagerInterface
 * @package App\Manager
 */
interface CategoryManagerInterface extends ManagerInterface
{
    /**
     * @param Category $category
     * @param bool $validation
     * @return CategoryManagerInterface
     */
    public function createCategory(Category $category, bool $validation = true): CategoryManagerInterface;

    /**
     * @param Category $category
     * @param bool $validation
     * @return CategoryManagerInterface
     */
    public function editCategory(Category $category, bool $validation = true): CategoryManagerInterface;

    /**
     * @param Category $category
     * @return CategoryManagerInterface
     */
    public function deleteCategory(Category $category): CategoryManagerInterface;

    /**
     * @return Category[]
     */
    public function getAllCategories(): array;
}