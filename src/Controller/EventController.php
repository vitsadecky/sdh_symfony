<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Entity\Event;
use App\Factory\EventFactory;
use App\Form\EventType;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Manager\EventManagerInterface;

/**
 * @method EventManagerInterface getManager()
 * @Route(
 *     {"cs": "{_locale}/udalost", "en": "/{_locale}/event"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class EventController extends AbstractAppController
{
    /**
     * EventController constructor.
     * @param ApplicationInterface $application
     * @param EventManagerInterface $eventManager
     */
    public function __construct(ApplicationInterface $application, EventManagerInterface $eventManager)
    {
        parent::__construct($application, $eventManager);
    }

    /**
     * @Route("/", name="event_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $events = [];
        try {
            $events = $this->getManager()->getAllEvents();
        } catch (\Throwable $throwable) {
            $this->getApplication()->handleError($throwable);
        }

        return $this->render('event/index.html.twig', ['events' => $events]);
    }

    /**
     * @Route({"cs": "/novy", "en": "/new"}, name="event_new", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Event")
     *
     * @param Request $request
     * @param EventFactory $eventFactory
     * @return Response
     */
    public function new(Request $request, EventFactory $eventFactory): Response
    {
        $event = $eventFactory->create($this->getUser());
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        $created = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->createEvent($event);    //validation execute on form layer
                $created = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $created === true
            ? $this->redirectToRoute('event_index')
            : $this->render('event/new.html.twig', ['event' => $event, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="event_show", methods="GET")
     * @ParamConverter("post", class="\App\Entity\Event")
     *
     * @param Event $event
     * @return Response
     */
    public function show(Event $event): Response
    {
        return $this->render('event/show.html.twig', ['event' => $event]);
    }

    /**
     * @Route({"cs": "/{id}/upravit", "en": "/{id}/edit"}, name="event_edit", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Event")
     *
     * @param Request $request
     * @param Event $event
     * @return Response
     */
    public function edit(Request $request, Event $event): Response
    {
        $form = $this->createForm(EventType::class, $event);
        $form->handleRequest($request);

        $edited = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->editEvent($event);    //validation execute on form layer
                $edited = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $edited === true
            ? $this->redirectToRoute('event_index')
            : $this->render('event/edit.html.twig', ['event' => $event, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="event_delete", methods="DELETE")
     * @ParamConverter("post", class="\App\Entity\Event")
     *
     * @param Request $request
     * @param Event $event
     * @return Response
     */
    public function delete(Request $request, Event $event): Response
    {
        if($this->isCsrfTokenValid('delete' . $event->getId(), $request->request->get('_token'))) {
            try {
                $this->getManager()->deleteEvent($event);
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $this->redirectToRoute('event_index');
    }
}
