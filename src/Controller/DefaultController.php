<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Controller;

use App\Factory\NotificationFactory;
use App\Form\NotificationType;
use App\Manager\Exception\NotificationException;
use App\Manager\NotificationManagerInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;


/**
 * Class DefaultController
 * @Route(
 *     {"cs": "{_locale}", "en": "/{_locale}"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 *
 * @package App\Controller
 */
class DefaultController extends AbstractController
{
    /**
     * Load the site definition and redirect to the default page.
     *
     * @Route("/", name="homepage",
     * defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"})
     * @throws \LogicException
     */
    public function indexMain(): Response
    {
        return $this->render('default/index.html.twig');
    }

    /**
     * @Route({"cs": "/kontakt","en": "/contact"}, name="contact")
     *
     * @param Request $request
     * @param NotificationFactory $notificationFactory
     * @param NotificationManagerInterface $notificationManager
     * @param LoggerInterface $logger
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function indexContact(Request $request,
                                 NotificationFactory $notificationFactory,
                                 NotificationManagerInterface $notificationManager,
                                 LoggerInterface $logger)
    {
        $notification = $notificationFactory->create();

        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if($form->isSubmitted()) {  //submit form
            try {
                $notificationManager->notify($notification);
            } catch (NotificationException $exception) {
                $this->addFlash('error', $exception->getMessage());
                $logger->warning($exception->getMessage());
            } catch (\Throwable $throwable) {
                $logger->error($throwable->getMessage());
            }
        }

        return $this->redirectToRoute('homepage');
    }
}
