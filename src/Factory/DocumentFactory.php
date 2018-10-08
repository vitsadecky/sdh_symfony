<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Factory;

use App\Entity\Document;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class DocumentFactory
 * @package App\Factory
 */
class DocumentFactory
{
    /**
     * @param UserInterface $user
     * @return Document
     */
    public function create(UserInterface $user): Document
    {
        $document = new Document($user);
        $document
            ->setDownloaded(0)
            ->setCreatedAt(new \DateTime());

        return $document;
    }
}
