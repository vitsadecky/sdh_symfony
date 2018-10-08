<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Subject;
use App\Repository\SubjectRepository;
use App\Event\SubjectEvent;
use App\Event\Factory\SubjectEventFactory;
use App\Manager\Exception\NotFound;
use App\Repository\SubjectRepositoryInterface;
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
class SubjectManager extends AbstractManager implements SubjectManagerInterface
{
    /** @var SubjectEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var SubjectRepositoryInterface */
    private $repository;

    /**
     * /**
     * UserManager constructor.
     * @param SubjectEventFactory $eventFactory
     * @param SubjectRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(SubjectEventFactory $eventFactory,
                                SubjectRepositoryInterface $repository,
                                EventDispatcherInterface $dispatcher,
                                EntityManagerInterface $entityManager,
                                ValidatorInterface $validator, LoggerInterface $logger,
                                TranslatorInterface $translator)
    {
        parent::__construct($entityManager, $validator, $logger, $translator);

        $this->eventFactory = $eventFactory;
        $this->dispatcher = $dispatcher;
        $this->repository = $repository;
    }

    /**
     * @return ObjectRepository|SubjectRepositoryInterface
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param string $code
     * @return Subject
     */
    public function getSubject(string $code): Subject
    {
        /** @var SubjectRepository $repository */
        $repository = $this->getRepository();

        $subject = $repository->findByCode($code);
        if($subject === null) {
            throw new NotFound(
                $this->getTranslator()->trans('The subject #%s not found', [$code]));
        }

        return $subject;
    }

    /**
     * @param Subject $subject
     * @param bool $validation
     * @return SubjectManagerInterface
     */
    public function createSubject(Subject $subject, bool $validation = true): SubjectManagerInterface
    {
        $event = $this->eventFactory->create($subject);
        $this->dispatcher->dispatch(SubjectEvent::CREATE_PRE, $event);

        parent::create($subject, $validation);

        $this->dispatcher->dispatch(SubjectEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Subject $subject
     * @param bool $validation
     * @return SubjectManagerInterface
     */
    public function editSubject(Subject $subject, bool $validation = true): SubjectManagerInterface
    {
        $event = $this->eventFactory->create($subject);
        $this->dispatcher->dispatch(SubjectEvent::EDIT_PRE, $event);

        parent::edit($subject, $validation);

        $this->dispatcher->dispatch(SubjectEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Subject $subject
     * @return SubjectManagerInterface
     */
    public function deleteSubject(Subject $subject): SubjectManagerInterface
    {
        $event = $this->eventFactory->create($subject);
        $this->dispatcher->dispatch(SubjectEvent::DELETE_PRE, $event);

        parent::delete($subject);

        $this->dispatcher->dispatch(SubjectEvent::DELETE_POST, $event);

        return $this;
    }

    /**
     * @return object[]|Subject[]
     */
    public function getAllSubjects(): array
    {
        return parent::getList();
    }
}