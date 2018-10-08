<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Event;
use App\Event\EventEvent;
use App\Event\Factory\EventEventFactory;
use App\Repository\EventRepositoryInterface;
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
class EventManager extends AbstractManager implements EventManagerInterface
{
    /** @var EventEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var EventRepositoryInterface */
    private $repository;

    /**
     * UserManager constructor.
     * @param EventEventFactory $eventFactory
     * @param EventRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(EventEventFactory $eventFactory,
                                EventRepositoryInterface $repository,
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
     * @return EventRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param Event $eventEntity
     * @param bool $validation
     * @return EventManagerInterface
     */
    public function createEvent(Event $eventEntity, bool $validation = true): EventManagerInterface
    {
        $event = $this->eventFactory->create($eventEntity);
        $this->dispatcher->dispatch(EventEvent::CREATE_PRE, $event);

        parent::create($eventEntity, $validation);

        $this->dispatcher->dispatch(EventEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Event $eventEntity
     * @param bool $validation
     * @return EventManagerInterface
     */
    public function editEvent(Event $eventEntity, bool $validation = true): EventManagerInterface
    {
        $event = $this->eventFactory->create($eventEntity);
        $this->dispatcher->dispatch(EventEvent::EDIT_PRE, $event);

        parent::edit($eventEntity, $validation);

        $this->dispatcher->dispatch(EventEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Event $eventEntity
     * @return EventManagerInterface
     */
    public function deleteEvent(Event $eventEntity): EventManagerInterface
    {
        $event = $this->eventFactory->create($eventEntity);
        $this->dispatcher->dispatch(EventEvent::DELETE_PRE, $event);

        parent::delete($eventEntity);

        $this->dispatcher->dispatch(EventEvent::DELETE_POST, $event);

        return $this;
    }

    /**
     * @return object[]|Event[]
     */
    public function getAllEvents(): array
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