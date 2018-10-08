<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Repository\RoleRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\Translation\TranslatorInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

/**
 * Class RoleManager
 * @package App\Manager
 */
class RoleManager extends AbstractManager implements RoleManagerInterface
{
    public const    //valid roles
        TYPE_OWNER = 'owner',
        TYPE_READER = 'reader',
        TYPE_ADMIN = 'admin',
        TYPE_DEVELOPER = 'developer',
        TYPE_TESTER = 'developer',
        TYPE_UNIT = 'unit',
        TYPE_VISITOR = 'visitor';

    /** @var RoleRepositoryInterface */
    private $repository;

    /**
     * /**
     * UserManager constructor.
     * @param RoleRepositoryInterface $repository
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(RoleRepositoryInterface $repository,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface $validator, LoggerInterface $logger,
                                TranslatorInterface $translator)
    {
        parent::__construct($entityManager, $validator, $logger, $translator);
        $this->repository = $repository;
    }

    /**
     * @return ObjectRepository|RoleRepositoryInterface
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * Return possible/valid role types
     * @return array
     */
    public static function getRoles(): array
    {
        return [
            self::TYPE_OWNER,
            self::TYPE_READER,
            self::TYPE_ADMIN,
            self::TYPE_DEVELOPER,
            self::TYPE_TESTER,
            self::TYPE_UNIT,
            self::TYPE_VISITOR
        ];
    }
}