<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\Article;
use App\Event\ArticleEvent;

/**
 * Class ArticleEventFactory
 * @package App\Event\Factory
 */
class ArticleEventFactory
{
    /**
     * @param Article $article
     * @return ArticleEvent
     */
    public function create(Article $article): ArticleEvent
    {
        return new ArticleEvent($article);
    }
}