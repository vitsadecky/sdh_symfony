<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:58
 */

namespace App\Listener;

use App\Event\CategoryEvent;

/**
 * Class CategoryListener
 * @package App\Listener
 */
class CategoryListener
{
    /**
     * @param CategoryEvent $event
     * @return CategoryListener
     */
    public function onArticleCreatePre(CategoryEvent $event): CategoryListener
    {
        // TODO: Implement onCreatePre() method.
        return $this;
    }

    /**
     * @param CategoryEvent $event
     * @return CategoryListener
     */
    public function onArticleCreatePost(CategoryEvent $event): CategoryListener
    {
        // TODO: Implement onCreatePost() method.
        return $this;
    }

    /**
     * @param CategoryEvent $event
     * @return CategoryListener
     */
    public function onArticleEditPre(CategoryEvent $event): CategoryListener
    {
        // TODO: Implement onEditPre() method.
        return $this;
    }

    /**
     * @param CategoryEvent $event
     * @return CategoryListener
     */
    public function onArticleEditPost(CategoryEvent $event): CategoryListener
    {
        // TODO: Implement onEditPost() method.
        return $this;
    }

    /**
     * @param CategoryEvent $event
     * @return CategoryListener
     */
    public function onArticleDeletePre(CategoryEvent $event): CategoryListener
    {
        // TODO: Implement onDeletePre() method.
        return $this;
    }

    /**
     * @param CategoryEvent $event
     * @return CategoryListener
     */
    public function onArticleDeletePost(CategoryEvent $event): CategoryListener
    {
        // TODO: Implement onDeletePost() method.
        return $this;
    }
}
