<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Category;
use App\Event\CategoryEvent;
use App\Event\Factory\CategoryEventFactory;
use App\Repository\CategoryRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\{EventDispatcher\EventDispatcherInterface,
    Translation\TranslatorInterface,
    Validator\Validator\ValidatorInterface};

/**
 * Class CategoryManager
 * @package App\Manager
 */
class CategoryManager extends AbstractManager implements CategoryManagerInterface
{
    /** @var CategoryEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var CategoryRepositoryInterface */
    private $repository;

    /**
     * UserManager constructor.
     * @param CategoryEventFactory $eventFactory
     * @param CategoryRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(CategoryEventFactory $eventFactory,
                                CategoryRepositoryInterface $repository,
                                EventDispatcherInterface $dispatcher,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface $validator,
                                LoggerInterface $logger,
                                TranslatorInterface $translator)
    {
        parent::__construct($entityManager, $validator, $logger, $translator);

        $this->eventFactory = $eventFactory;
        $this->dispatcher = $dispatcher;
        $this->repository = $repository;
    }

    /**
     * @return CategoryRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param Category $category
     * @param bool $validation
     * @return CategoryManagerInterface
     */
    public function createCategory(Category $category, bool $validation = true): CategoryManagerInterface
    {
        $event = $this->eventFactory->create($category);
        $this->dispatcher->dispatch(CategoryEvent::CREATE_PRE, $event);

        parent::create($category, $validation);

        $this->dispatcher->dispatch(CategoryEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Category $category
     * @param bool $validation
     * @return CategoryManagerInterface
     */
    public function editCategory(Category $category, bool $validation = true): CategoryManagerInterface
    {
        $event = $this->eventFactory->create($category);
        $this->dispatcher->dispatch(CategoryEvent::EDIT_PRE, $event);

        parent::edit($category, $validation);

        $this->dispatcher->dispatch(CategoryEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Category $category
     * @return CategoryManagerInterface
     */
    public function deleteCategory(Category $category): CategoryManagerInterface
    {
        $event = $this->eventFactory->create($category);
        $this->dispatcher->dispatch(CategoryEvent::DELETE_PRE, $event);

        parent::delete($category);

        $this->dispatcher->dispatch(CategoryEvent::DELETE_POST, $event);

        return $this;
    }

    /**
     * @return object[]|Category[]
     */
    public function getAllCategories(): array
    {
        return parent::getList();
    }

    /**
     * There is no need to check from here
     * @param object $entity
     * @return bool
     */
    protected function check($entity): bool
    {
        return true;
    }
}