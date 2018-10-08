<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:38
 */

namespace App\Event;

use App\Entity\Category;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class ArticleEvent
 * @package App\Event
 */
class CategoryEvent extends Event
{
    public const
        CREATE_PRE = self::EVENT_PREFIX . '.createPre',
        CREATE_POST = self::EVENT_PREFIX . '.createPost',
        EDIT_PRE = self::EVENT_PREFIX . '.editPre',
        EDIT_POST = self::EVENT_PREFIX . '.editPost',
        DELETE_PRE = self::EVENT_PREFIX . '.deletePre',
        DELETE_POST = self::EVENT_PREFIX . '.deletePost';

    private const EVENT_PREFIX = 'category';

    /** @var Category */
    private $category;

    /**
     * UserEvent constructor.
     * @param Category $category
     */
    public function __construct(Category $category)
    {
        $this->category = $category;
    }

    /**
     * @return Category
     */
    public function getCategory(): Category
    {
        return $this->category;
    }
}