<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * Load the site definition and redirect to the default page.
     *
     * @Route("/", name="homepage")
     */
    public function indexHomepage()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/novinky", name="news")
     */
    public function indexNews()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/udalosti", name="events")
     */
    public function indexEvents()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/galerie", name="gallery")
     */
    public function indexGallery()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/diskuze", name="forum")
     */
    public function indexForum()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/kontakt", name="contact")
     */
    public function indexContact()
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route("/nenalezeno", name="notFound")
     */
    public function indexNotFound()
    {
        return $this->render('default/index.html.twig');
    }
}
