<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Sdh;
use App\Event\SdhEvent;
use App\Event\Factory\SdhEventFactory;
use App\Repository\SdhRepositoryInterface;
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
class SdhManager extends AbstractManager implements SdhManagerInterface
{
    /** @var SdhEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var SdhRepositoryInterface */
    private $repository;

    /**
     * UserManager constructor.
     * @param SdhEventFactory $eventFactory
     * @param SdhRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(SdhEventFactory $eventFactory,
                                SdhRepositoryInterface $repository,
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
     * @return SdhRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param Sdh $sdh
     * @param bool $validation
     * @return SdhManagerInterface
     */
    public function createSdh(Sdh $sdh, bool $validation = true): SdhManagerInterface
    {
        $event = $this->eventFactory->create($sdh);
        $this->dispatcher->dispatch(SdhEvent::CREATE_PRE, $event);

        parent::create($sdh, $validation);

        $this->dispatcher->dispatch(SdhEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Sdh $sdh
     * @param bool $validation
     * @return SdhManagerInterface
     */
    public function editSdh(Sdh $sdh, bool $validation = true): SdhManagerInterface
    {
        $event = $this->eventFactory->create($sdh);
        $this->dispatcher->dispatch(SdhEvent::EDIT_PRE, $event);

        parent::edit($sdh, $validation);

        $this->dispatcher->dispatch(SdhEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Sdh $sdh
     * @return SdhManagerInterface
     */
    public function deleteSdh(Sdh $sdh): SdhManagerInterface
    {
        $event = $this->eventFactory->create($sdh);
        $this->dispatcher->dispatch(SdhEvent::DELETE_PRE, $event);

        parent::delete($sdh);

        $this->dispatcher->dispatch(SdhEvent::DELETE_POST, $event);

        return $this;
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

    /**
     * @param Sdh $sdh
     * @return SdhManagerInterface
     */
    public function getHistory(Sdh $sdh): SdhManagerInterface
    {
        // TODO: Implement getHistory() method.
        return $this;
    }

    /**
     * @param Sdh $sdh
     * @return mixed
     */
    public function editHistory(Sdh $sdh): SdhManagerInterface
    {
        // TODO: Implement editHistory() method.
        return $this;
    }
}