<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 12:45
 */

namespace App\Repository;

use App\Entity\Traffic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Traffic|null find($id, $lockMode = null, $lockVersion = null)
 * @method Traffic|null findOneBy(array $criteria, array $orderBy = null)
 * @method Traffic[]    findAll()
 * @method Traffic[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TrafficRepository extends ServiceEntityRepository implements TrafficRepositoryInterface
{
    /**
     * TrafficRepository constructor.
     * @param RegistryInterface $registry
     */
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Traffic::class);
    }

//    /**
//     * @return Traffic[] Returns an array of Traffic objects
//     */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Traffic
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
