<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Repository;

use App\Entity\Sdh;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Sdh|null find($id, $lockMode = null, $lockVersion = null)
 * @method Sdh|null findOneBy(array $criteria, array $orderBy = null)
 * @method Sdh[]    findAll()
 * @method Sdh[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SdhRepository extends ServiceEntityRepository implements SdhRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Sdh::class);
    }
}
