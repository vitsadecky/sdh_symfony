<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Manager\ManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * Class AbstractApplicationController
 * @package App\Controller
 */
abstract class AbstractAppController extends AbstractController
{
    /** @var ManagerInterface */
    private $manager;

    /** @var ApplicationInterface */
    private $application;

    /**
     * AbstractAppController constructor.
     * @param ApplicationInterface $application
     * @param ManagerInterface $articleManager
     */
    public function __construct(ApplicationInterface $application, ManagerInterface $articleManager)
    {
        $this->application = $application;
        $this->manager = $articleManager;
    }

    /**
     * @return ManagerInterface
     */
    public function getManager(): ManagerInterface
    {
        return $this->manager;
    }

    /**
     * @return ApplicationInterface
     */
    public function getApplication(): ApplicationInterface
    {
        return $this->application;
    }
}
