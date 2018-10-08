<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Repository;

use App\Entity\Article;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Article|null find($id, $lockMode = null, $lockVersion = null)
 * @method Article|null findOneBy(array $criteria, array $orderBy = null)
 * @method Article[]    findAll()
 * @method Article[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ArticleRepository extends ServiceEntityRepository implements ArticleRepositoryInterface
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Article::class);
    }

    /**
     * @param int|null $year
     * @return Article|null
     */
    public function findTheMostVisitedArticle(?int $year = null): ?Article
    {
        $qb = $this->createQueryBuilder('article');
        if($year !== null) {
            $currentYearDatetime = new \DateTime();
            $currentYearDatetime
                ->setDate($year, 1, 1)
                ->setTime(0, 0);

            $qb
                ->where('article.publishedAt != :publishedAt')
                ->setParameter('publishedAt', $currentYearDatetime);
        }

        $results = $qb->orderBy('article.attendance', 'DESC')
            ->setMaxResults(1)
            ->getQuery()
            ->getResult();

        return !empty($results)
            ? array_shift($results)
            : null;
    }
}
