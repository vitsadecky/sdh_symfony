<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use App\Manager\Exception\{InvalidDataException};
use Symfony\Component\{Translation\TranslatorInterface, Validator\Validator\ValidatorInterface};

/**
 * Class AbstractManager
 * @package App\Manager
 */
abstract class AbstractManager implements ManagerInterface
{
    /** @var EntityManagerInterface */
    private $entityManager;

    /** @var ValidatorInterface */
    private $validator;

    /** @var LoggerInterface */
    private $logger;

    /** @var TranslatorInterface */
    private $translator;

    /**
     * AbstractManager constructor.
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(EntityManagerInterface $entityManager,
                                ValidatorInterface $validator,
                                LoggerInterface $logger,
                                TranslatorInterface $translator)
    {
        $this->entityManager = $entityManager;
        $this->validator = $validator;
        $this->logger = $logger;
        $this->translator = $translator;
    }

    /**
     * @return ObjectRepository
     */
    abstract protected function getRepository(): ObjectRepository;


    /**
     * @return bool
     */
    public function canCreate(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function canView(): bool
    {
        return true;
    }

    /**
     * @return bool
     */
    public function canDelete(): bool
    {
        return true;
    }


    /**
     * @return EntityManagerInterface
     */
    public function getEntityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    /**
     * @return ValidatorInterface
     */
    public function getValidator(): ValidatorInterface
    {
        return $this->validator;
    }

    /**
     * @return LoggerInterface
     */
    public function getLogger(): LoggerInterface
    {
        return $this->logger;
    }

    /**
     * @return TranslatorInterface
     */
    public function getTranslator(): TranslatorInterface
    {
        return $this->translator;
    }

    /**
     * @param object $entity
     * @param bool $validation
     * @return AbstractManager
     */
    public function create($entity, bool $validation = true): AbstractManager
    {
        $this->check($entity);
        if($validation) {
            $this->validate($entity);
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this;
    }

    /**
     * @param object $entity
     * @return AbstractManager
     */
    public function delete($entity): AbstractManager
    {
        $this->check($entity);

        $this->entityManager->remove($entity);
        $this->entityManager->flush();

        return $this;
    }

    /**
     * @param object $entity
     * @param bool $validation
     * @return AbstractManager
     */
    public function edit($entity, bool $validation = true): AbstractManager
    {
        $this->check($entity);
        if($validation) {
            $this->validate($entity);
        }

        $this->entityManager->persist($entity);
        $this->entityManager->flush();

        return $this;
    }

    /**
     * @return object[]
     */
    public function getList(): array
    {
        return $this->getRepository()->findAll();
    }


    /**
     * @param object $entity
     * @return AbstractManager
     */
    protected function validate($entity): AbstractManager
    {
        $errors = $this->validator->validate($entity);
        if(\count($errors) > 0) {
            throw new InvalidDataException($errors);
        }

        return $this;
    }

    /**
     * @param object $entity
     * @return bool
     */
    protected function check($entity): bool
    {
        $isMappedOrmEntity = true;
        $this
            ->getEntityManager()
            ->getMetadataFactory()
            ->getMetadataFor(\get_class($entity));

        return $isMappedOrmEntity;
    }
}