<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:58
 */

namespace App\Listener;

use App\Event\ArticleEvent;

/**
 * Class ArticleListener
 * @package App\Listener
 */
class ArticleListener
{
    /**
     * @param ArticleEvent $event
     * @return ArticleListener
     */
    public function onArticleCreatePre(ArticleEvent $event): ArticleListener
    {
        // TODO: Implement onCreatePre() method.

        return $this;
    }

    /**
     * @param ArticleEvent $event
     * @return ArticleListener
     */
    public function onArticleCreatePost(ArticleEvent $event): ArticleListener
    {
        // TODO: Implement onCreatePost() method.
        return $this;
    }

    /**
     * @param ArticleEvent $event
     * @return ArticleListener
     */
    public function onArticleEditPre(ArticleEvent $event): ArticleListener
    {
        // TODO: Implement onEditPre() method.
        return $this;
    }

    /**
     * @param ArticleEvent $event
     * @return ArticleListener
     */
    public function onArticleEditPost(ArticleEvent $event): ArticleListener
    {
        // TODO: Implement onEditPost() method.
        return $this;
    }

    /**
     * @param ArticleEvent $event
     * @return ArticleListener
     */
    public function onArticleDeletePre(ArticleEvent $event): ArticleListener
    {
        // TODO: Implement onDeletePre() method.
        return $this;
    }

    /**
     * @param ArticleEvent $event
     * @return ArticleListener
     */
    public function onArticleDeletePost(ArticleEvent $event): ArticleListener
    {
        // TODO: Implement onDeletePost() method.
        return $this;
    }
}
