<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\User;
use App\Event\Factory\UserEventFactory;
use App\Event\UserEvent;
use App\Repository\UserRepositoryInterface;
use Doctrine\Common\Persistence\ObjectRepository;
use Doctrine\ORM\EntityManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Component\{EventDispatcher\EventDispatcherInterface,
    Security\Core\Encoder\UserPasswordEncoderInterface,
    Translation\TranslatorInterface,
    Validator\Validator\ValidatorInterface};

/**
 * Class UserManager
 * @package App\Manager
 */
class UserManager extends AbstractManager implements UserManagerInterface
{
    /** @var UserEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var UserRepositoryInterface|ObjectRepository */
    private $repository;

    /** @var UserPasswordEncoderInterface */
    private $passwordEncoder;

    /**
     * UserManager constructor.
     * @param UserEventFactory $eventFactory
     * @param UserRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     * @param UserPasswordEncoderInterface $passwordEncoder
     */
    public function __construct(UserEventFactory $eventFactory,
                                UserRepositoryInterface $repository,
                                EventDispatcherInterface $dispatcher,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface $validator,
                                LoggerInterface $logger,
                                TranslatorInterface $translator,
                                UserPasswordEncoderInterface $passwordEncoder)
    {
        parent::__construct($entityManager, $validator, $logger, $translator);

        $this->eventFactory = $eventFactory;
        $this->dispatcher = $dispatcher;
        $this->repository = $repository;
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @return UserRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @return bool
     */
    public function isLogged(): bool
    {
        //pktodo dodelat
        return true;
    }

    /**
     * @param User $user
     * @return UserManager
     */
    public function logOutUser(User $user): UserManagerInterface
    {
        if(!$this->isLogged()) {
            throw new \RuntimeException('is logged yet!');
            //pktodo vyjimka neni jiz zalogovany
        }

        return $this;
    }

    /**
     * @param User $user
     * @param bool $validation
     * @return UserManager
     */
    public function createUser(User $user, bool $validation = true): UserManagerInterface
    {
        $user->setPassword($this->passwordEncoder->encodePassword($user, $user->getPassword()));

        $event = $this->eventFactory->create($user);
        $this->dispatcher->dispatch(UserEvent::CREATE_PRE, $event);
        parent::create($user, $validation);

        $this->dispatcher->dispatch(UserEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param User $user
     * @param bool $validation
     * @return UserManager
     */
    public function editUser(User $user, bool $validation = true): UserManagerInterface
    {
        $event = $this->eventFactory->create($user);
        $this->dispatcher->dispatch(UserEvent::EDIT_PRE, $event);

        parent::edit($user, $validation);

        $this->dispatcher->dispatch(UserEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param User $user
     * @return UserManager
     */
    public function deleteUser(User $user): UserManagerInterface
    {
        $event = $this->eventFactory->create($user);
        $this->dispatcher->dispatch(UserEvent::DELETE_PRE, $event);

        parent::delete($user);

        $this->dispatcher->dispatch(UserEvent::DELETE_POST, $event);

        return $this;
    }

    /**
     * @return object[]|User[]
     */
    public function getAllUsers(): array
    {
        return parent::getList();
    }

    /**
     * @return User[]
     */
    public function getAllActiveUsers(): array
    {
        return $this->repository->findBy(['isActive' => true]);
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