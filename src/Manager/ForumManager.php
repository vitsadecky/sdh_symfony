<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Forum;
use App\Event\ForumEvent;
use App\Event\Factory\ForumEventFactory;
use App\Repository\ForumRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\{EventDispatcher\EventDispatcherInterface,
    Translation\TranslatorInterface,
    Validator\Validator\ValidatorInterface};

/**
 * Class UserManager
 * @package App\Manager
 */
class ForumManager extends AbstractManager implements ForumManagerInterface
{
    /** @var ForumEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var ForumRepositoryInterface */
    private $repository;

    /**
     * UserManager constructor.
     * @param ForumEventFactory $eventFactory
     * @param ForumRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(ForumEventFactory $eventFactory,
                                ForumRepositoryInterface $repository,
                                EventDispatcherInterface $dispatcher,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface $validator,
                                LoggerInterface $logger,
                                TranslatorInterface $translator)
    {
        $this->eventFactory = $eventFactory;
        $this->dispatcher = $dispatcher;
        $this->repository = $repository;

        parent::__construct($entityManager, $validator, $logger, $translator);
    }

    /**
     * @return ForumRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param Forum $forum
     * @param bool $validation
     * @return ForumManagerInterface
     */
    public function createForum(Forum $forum, bool $validation = true): ForumManagerInterface
    {
        $event = $this->eventFactory->create($forum);
        $this->dispatcher->dispatch(ForumEvent::CREATE_PRE, $event);

        parent::create($forum, $validation);

        $this->dispatcher->dispatch(ForumEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Forum $forum
     * @param bool $validation
     * @return ForumManagerInterface
     */
    public function editForum(Forum $forum, bool $validation = true): ForumManagerInterface
    {
        $event = $this->eventFactory->create($forum);
        $this->dispatcher->dispatch(ForumEvent::EDIT_PRE, $event);

        parent::edit($forum, $validation);

        $this->dispatcher->dispatch(ForumEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Forum $forum
     * @return ForumManagerInterface
     */
    public function deleteForum(Forum $forum): ForumManagerInterface
    {
        $event = $this->eventFactory->create($forum);
        $this->dispatcher->dispatch(ForumEvent::DELETE_PRE, $event);

        parent::delete($forum);

        $this->dispatcher->dispatch(ForumEvent::DELETE_POST, $event);

        return $this;
    }

    /**
     * @return object[]|Forum[]
     */
    public function getAllForums(): array
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