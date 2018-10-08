<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\Gallery;
use App\Event\GalleryEvent;

/**
 * Class GalleryEventFactory
 * @package App\Event\Factory
 */
class GalleryEventFactory
{
    /**
     * @param Gallery $gallery
     * @return GalleryEvent
     */
    public function create(Gallery $gallery): GalleryEvent
    {
        return new GalleryEvent($gallery);
    }
}