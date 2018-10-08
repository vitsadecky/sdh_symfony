<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 29. 9. 2018
 * Time: 18:29
 */

namespace App\Tests\Repository;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use App\Entity\User;

/**
 * Class UserRepository
 * @package App\Tests\Repository
 */
class UserRepositoryTest extends KernelTestCase
{
    /**
     * @var \Doctrine\ORM\EntityManager
     */
    private $entityManager;

    /**
     * {@inheritDoc}
     */
    protected function setUp(): void
    {
        $kernel = self::bootKernel();

        $this->entityManager = $kernel->getContainer()
            ->get('doctrine')
            ->getManager();
    }

    /**
     * @throws \Exception
     */
    public function testFindUsers(): void
    {
        $users = $this->entityManager
            ->getRepository(User::class)
            ->findAll();

        $this->assertCount(1, $users);
    }

    /**
     * {@inheritDoc}
     */
    protected function tearDown()
    {
        parent::tearDown();

        $this->entityManager->close();
        $this->entityManager = null; // avoid memory leaks
    }

}