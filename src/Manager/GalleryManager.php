<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Gallery;
use App\Event\GalleryEvent;
use App\Event\Factory\GalleryEventFactory;
use App\Repository\GalleryRepositoryInterface;
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
class GalleryManager extends AbstractManager implements GalleryManagerInterface
{
    /** @var GalleryEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var GalleryRepositoryInterface */
    private $repository;

    /**
     * UserManager constructor.
     * @param GalleryEventFactory $eventFactory
     * @param GalleryRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(GalleryEventFactory $eventFactory,
                                GalleryRepositoryInterface $repository,
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
     * @return GalleryRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param Gallery $gallery
     * @param bool $validation
     * @return GalleryManagerInterface
     */
    public function createGallery(Gallery $gallery, bool $validation = true): GalleryManagerInterface
    {
        $event = $this->eventFactory->create($gallery);
        $this->dispatcher->dispatch(GalleryEvent::CREATE_PRE, $event);

        parent::create($gallery, $validation);

        $this->dispatcher->dispatch(GalleryEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Gallery $gallery
     * @param bool $validation
     * @return GalleryManagerInterface
     */
    public function editGallery(Gallery $gallery, bool $validation = true): GalleryManagerInterface
    {
        $event = $this->eventFactory->create($gallery);
        $this->dispatcher->dispatch(GalleryEvent::EDIT_PRE, $event);

        parent::edit($gallery, $validation);

        $this->dispatcher->dispatch(GalleryEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Gallery $gallery
     * @return GalleryManagerInterface
     */
    public function deleteGallery(Gallery $gallery): GalleryManagerInterface
    {
        $event = $this->eventFactory->create($gallery);
        $this->dispatcher->dispatch(GalleryEvent::DELETE_PRE, $event);

        parent::delete($gallery);

        $this->dispatcher->dispatch(GalleryEvent::DELETE_POST, $event);

        return $this;
    }

    /**
     * @return object[]|Gallery[]
     */
    public function getWholeGallery(): array
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