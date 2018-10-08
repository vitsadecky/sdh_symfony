<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Entity\Forum;
use App\Factory\ForumFactory;
use App\Form\ForumType;
use App\Manager\ForumManagerInterface;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @method ForumManagerInterface getManager()
 * @Route(
 *     {"cs": "{_locale}/diskuze", "en": "/{_locale}/forum"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class ForumController extends AbstractAppController
{
    /**
     * ForumController constructor.
     * @param ApplicationInterface $application
     * @param ForumManagerInterface $forumManager
     */
    public function __construct(ApplicationInterface $application,
                                ForumManagerInterface $forumManager)
    {
        parent::__construct($application, $forumManager);
    }

    /**
     * @Route("/", name="forum_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $forums = [];
        try {
            $forums = $this->getManager()->getAllForums();
        } catch (\Throwable $throwable) {
            $this->getApplication()->handleError($throwable);
        }

        return $this->render('forum/index.html.twig', ['forums' => $forums]);
    }

    /**
     * @Route({"cs": "/novy", "en": "/new"}, name="forum_new", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Forum")
     *
     * @param Request $request
     * @param ForumFactory $forumFactory
     * @return Response
     */
    public function new(Request $request, ForumFactory $forumFactory): Response
    {
        $forum = $forumFactory->create();
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        $created = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->createForum($forum);    //validation execute on form layer
                $created = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $created === true
            ? $this->redirectToRoute('forum_index')
            : $this->render('forum/new.html.twig', ['forum' => $forum, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="forum_show", methods="GET")
     * @ParamConverter("post", class="\App\Entity\Forum")
     *
     * @param Forum $forum
     * @return Response
     */
    public function show(Forum $forum): Response
    {
        return $this->render('forum/show.html.twig', ['forum' => $forum]);
    }

    /**
     * @Route({"cs": "/{id}/upravit", "en": "/{id}/edit"}, name="forum_edit", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Forum")
     *
     * @param Request $request
     * @param Forum $forum
     * @return Response
     */
    public function edit(Request $request, Forum $forum): Response
    {
        $form = $this->createForm(ForumType::class, $forum);
        $form->handleRequest($request);

        $edited = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->editForum($forum);    //validation execute on form layer
                $edited = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $edited === true
            ? $this->redirectToRoute('forum_index')
            : $this->render('forum/edit.html.twig', ['forum' => $forum, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="forum_delete", methods="DELETE")
     * @ParamConverter("post", class="\App\Entity\Forum")
     *
     * @param Request $request
     * @param Forum $forum
     * @return Response
     */
    public function delete(Request $request, Forum $forum): Response
    {
        if($this->isCsrfTokenValid('delete' . $forum->getId(), $request->request->get('_token'))) {
            try {
                $this->getManager()->deleteForum($forum);
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $this->redirectToRoute('forum_index');
    }
}
