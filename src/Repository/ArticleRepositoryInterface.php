<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Repository;

use App\Entity\Article;

/**
 * Interface ArticleRepositoryInterface
 * @package App\Repository
 */
interface ArticleRepositoryInterface
{
    /**
     * @param int|null $year
     * @return Article|null
     */
    public function findTheMostVisitedArticle(?int $year = null): ?Article;
}
