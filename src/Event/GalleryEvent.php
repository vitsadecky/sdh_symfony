<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:38
 */

namespace App\Event;

use App\Entity\Gallery;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class GalleryEvent
 * @package App\Event
 */
class GalleryEvent extends Event
{
    public const
        CREATE_PRE = self::EVENT_PREFIX . '.createPre',
        CREATE_POST = self::EVENT_PREFIX . '.createPost',
        EDIT_PRE = self::EVENT_PREFIX . '.editPre',
        EDIT_POST = self::EVENT_PREFIX . '.editPost',
        DELETE_PRE = self::EVENT_PREFIX . '.deletePre',
        DELETE_POST = self::EVENT_PREFIX . '.deletePost';

    private const EVENT_PREFIX = 'gallery';


    /** @var Gallery */
    private $gallery;

    /**
     * UserEvent constructor.
     * @param Gallery $gallery
     */
    public function __construct(Gallery $gallery)
    {
        $this->gallery = $gallery;
    }

    /**
     * @return Gallery
     */
    public function getGallery(): Gallery
    {
        return $this->gallery;
    }
}