<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class FireBrigadeController
 * @package App\Controller
 */
class FireBrigadeController extends AbstractController
{
    /**
     * @Route("/sbor/clenove", name="members")
     */
    public function getMembers()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/sbor/jednotka", name="unit")
     */
    public function getUnit()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/sbor/historie", name="history")
     */
    public function indexHistory()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/sbor/pohary", name="cups")
     */
    public function indexCups()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/sbor/technika", name="technology")
     */
    public function indexTechnology()
    {
        return $this->render('default/index.html.twig');
    }
}
