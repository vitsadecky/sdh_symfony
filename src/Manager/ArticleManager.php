<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:33
 */

namespace App\Manager;

use App\Entity\Article;
use App\Event\ArticleEvent;
use App\Event\Factory\ArticleEventFactory;
use App\Repository\ArticleRepositoryInterface;
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
class ArticleManager extends AbstractManager implements ArticleManagerInterface
{
    /** @var ArticleEventFactory */
    private $eventFactory;

    /** @var EventDispatcherInterface */
    private $dispatcher;

    /** @var ArticleRepositoryInterface|ObjectRepository */
    private $repository;

    /**
     * UserManager constructor.
     * @param ArticleEventFactory $eventFactory
     * @param ArticleRepositoryInterface $repository
     * @param EventDispatcherInterface $dispatcher
     * @param EntityManagerInterface $entityManager
     * @param ValidatorInterface $validator
     * @param LoggerInterface $logger
     * @param TranslatorInterface $translator
     */
    public function __construct(ArticleEventFactory $eventFactory,
                                ArticleRepositoryInterface $repository,
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
     * @return ArticleRepositoryInterface|ObjectRepository
     */
    protected function getRepository(): ObjectRepository
    {
        return $this->repository;
    }

    /**
     * @param Article $article
     * @param bool $validation
     * @return ArticleManagerInterface
     */
    public function createArticle(Article $article, bool $validation = true): ArticleManagerInterface
    {
        $event = $this->eventFactory->create($article);
        $this->dispatcher->dispatch(ArticleEvent::CREATE_PRE, $event);

        parent::create($article, $validation);

        $this->dispatcher->dispatch(ArticleEvent::CREATE_POST, $event);

        return $this;
    }

    /**
     * @param Article $article
     * @param bool $validation
     * @return ArticleManagerInterface
     */
    public function editArticle(Article $article, bool $validation = true): ArticleManagerInterface
    {
        $event = $this->eventFactory->create($article);
        $this->dispatcher->dispatch(ArticleEvent::EDIT_PRE, $event);

        parent::edit($article, $validation);

        $this->dispatcher->dispatch(ArticleEvent::EDIT_POST, $event);

        return $this;
    }

    /**
     * @param Article $article
     * @return ArticleManagerInterface
     */
    public function deleteArticle(Article $article): ArticleManagerInterface
    {
        $event = $this->eventFactory->create($article);
        $this->dispatcher->dispatch(ArticleEvent::DELETE_PRE, $event);

        parent::delete($article);

        $this->dispatcher->dispatch(ArticleEvent::DELETE_POST, $event);

        return $this;
    }


    /**
     * @return object[]|Article[]
     */
    public function getAllArticles(): array
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