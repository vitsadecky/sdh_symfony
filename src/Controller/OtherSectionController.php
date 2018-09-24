<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OtherSectionController
 * @package App\Controller
 */
class OtherSectionController extends AbstractController
{
    /**
     * @Route("/ostatni/dokumenty", name="documents")
     */
    public function indexDocuments()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/florian", name="florian")
     */
    public function indexFlorian()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/oznaceniFunkcionaru", name="designation")
     */
    public function indexDesignation()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/hasiciPristroje/popis", name="descriptionFireEX")
     */
    public function indexDescriptionOfFireExtinguishers()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/hasiciPristroje/efektivita", name="efficientFireEX")
     */
    public function indexEfficientOfFireExtinguishers()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/haseniPozaru", name="firefighting")
     */
    public function indexFirefighting()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/vazaniUzlu", name="nodes")
     */
    public function indexNodes()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/sponzoring", name="sponsoring")
     */
    public function indexSponsoring()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/ostatni/odkazy", name="references")
     */
    public function indexReferences()
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }
}
