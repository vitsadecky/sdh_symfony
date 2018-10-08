<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Article;
use App\Entity\EntityInterface;

/**
 * Class ArticleFactory
 * @package App\Entity
 */
class ArticleFactory
{
    /**
     * @return Article|EntityInterface
     */
    public function create(): EntityInterface
    {
        $article = new Article();
        $article
            ->setAttendance(0)
            ->setPublishedAt(new \DateTime());

        return $article;
    }
}
