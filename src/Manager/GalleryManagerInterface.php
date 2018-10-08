<?php declare(strict_types=1);
/**
 * Article: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Gallery;

/**
 * Interface GalleryManagerInterface
 * @package App\Manager
 */
interface GalleryManagerInterface extends ManagerInterface
{
    /**
     * @param Gallery $category
     * @param bool $validation
     * @return GalleryManagerInterface
     */
    public function createGallery(Gallery $category, bool $validation = true): GalleryManagerInterface;

    /**
     * @param Gallery $gallery
     * @param bool $validation
     * @return GalleryManagerInterface
     */
    public function editGallery(Gallery $gallery, bool $validation = true): GalleryManagerInterface;

    /**
     * @param Gallery $gallery
     * @return GalleryManagerInterface
     */
    public function deleteGallery(Gallery $gallery): GalleryManagerInterface;

    /**
     * @return Gallery[]
     */
    public function getWholeGallery(): array;
}