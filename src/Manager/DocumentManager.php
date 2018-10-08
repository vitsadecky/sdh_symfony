<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Document;
use App\Event\DocumentEvent;
use App\Event\Factory\DocumentEventFactory;
use App\Repository\DocumentRepositoryInterface;
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
class DocumentManager extends AbstractManager implements DocumentManagerInterface
{
    /** @var DocumentEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var DocumentRepositoryInterface */
    private $repository;

    /**
     * UserManager constructor.
     * @param DocumentEventFactory $eventFactory
     * @param DocumentRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(DocumentEventFactory $eventFactory,
                                DocumentRepositoryInterface $repository,
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
     * @return DocumentRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param Document $document
     * @param bool $validation
     * @return DocumentManagerInterface
     */
    public function createDocument(Document $document, bool $validation = true): DocumentManagerInterface
    {
        $event = $this->eventFactory->create($document);
        $this->dispatcher->dispatch(DocumentEvent::CREATE_PRE, $event);

        parent::create($document, $validation);

        $this->dispatcher->dispatch(DocumentEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Document $document
     * @param bool $validation
     * @return DocumentManagerInterface
     */
    public function editDocument(Document $document, bool $validation = true): DocumentManagerInterface
    {
        $event = $this->eventFactory->create($document);
        $this->dispatcher->dispatch(DocumentEvent::EDIT_PRE, $event);

        parent::edit($document, $validation);

        $this->dispatcher->dispatch(DocumentEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Document $document
     * @return DocumentManagerInterface
     */
    public function deleteDocument(Document $document): DocumentManagerInterface
    {
        $event = $this->eventFactory->create($document);
        $this->dispatcher->dispatch(DocumentEvent::DELETE_PRE, $event);

        parent::delete($document);

        $this->dispatcher->dispatch(DocumentEvent::DELETE_POST, $event);

        return $this;
    }

    /**
     * @return object[]|Document[]
     */
    public function getAllDocuments(): array
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