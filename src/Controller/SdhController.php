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
 * @method SdhController getManager()
 *
 * @Route(
 *     {"cs": "{_locale}/sdh", "en": "/{_locale}/sdh"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class SdhController extends AbstractController
{
    /**
     * @Route({"cs": "/{_locale}/clen","en": "/{_locale}/member"}, name="members",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function getMembers(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route({"cs": "/jednotka","en": "/unit"}, name="unit",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function getUnit(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route({"cs": "/historie","en": "/history"}, name="history",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexHistory(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route({"cs": "/pohar","en": "/{_locale}/team/cup"}, name="cups",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexCups(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route({"cs": "/technika","en": "technology"}, name="technology",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     */
    public function indexTechnology(): Response
    {
        return $this->render('default/index.html.twig');
    }
}
