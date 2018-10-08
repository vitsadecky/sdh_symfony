<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class OtherSectionController
 * @package App\Controller
 */
class OtherSectionController extends AbstractController
{
    /**
     * @Route({"cs": "/{_locale}/ostatni/dokumenty","en": "/{_locale}/other/documents"}, name="documents",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexDocuments(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route("/{_locale}/team/florian", name="florian",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexFlorian(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route({"cs": "/{_locale}/ostatni/oznaceniFunkcionaru","en": "/{_locale}/other/designation"}, name="designation",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexDesignation(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route({"cs": "/{_locale}/ostatni/hasiciPristroje/popis","en": "/{_locale}/other/extinguishers/description"},
     * name="descriptionFireEX",defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexDescriptionOfFireExtinguishers(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route({"cs": "/{_locale}/ostatni/hasiciPristroje/efektivita","en": "/{_locale}/other/extinguishers/efficiency"},
     * name="efficiencyFireEX",defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexEfficientOfFireExtinguishers(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route({"cs": "/{_locale}/ostatni/haseniPozaru","en": "/{_locale}/other/firefighting"},name="firefighting",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexFirefighting(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route({"cs": "/{_locale}/ostatni/vazaniUzlu","en": "/{_locale}/other/knottingNodes"},name="nodes",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexNodes(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route({"cs": "/{_locale}/ostatni/sponzoring","en": "/{_locale}/other/sponsoring"},name="sponsoring",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexSponsoring(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }

    /**
     * @Route({"cs": "/{_locale}/ostatni/odkazy","en": "/{_locale}/other/references"},name="references",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexReferences(): Response
    {
        return $this->render('other_section/index.html.twig', [
            'controller_name' => 'OtherSectionController',
        ]);
    }
}
