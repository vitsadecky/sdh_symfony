<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Gallery;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class GalleryFactory
 * @package App\Factory
 */
class GalleryFactory
{
    /**
     * @param UserInterface $user
     * @return Gallery
     */
    public function create(UserInterface $user): Gallery
    {
        return new Gallery($user);
    }
}
