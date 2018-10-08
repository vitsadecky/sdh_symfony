<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Entity\User;
use App\Factory\UserFactory;
use App\Form\UserType;
use App\Manager\UserManagerInterface;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

/**
 * @method UserManagerInterface getManager()
 *
 * @Route(
 *     {"cs": "{_locale}/uzivatel", "en": "/{_locale}/user"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class UserController extends AbstractAppController
{
    /**
     * UserController constructor.
     * @param ApplicationInterface $application
     * @param UserManagerInterface $articleManager
     */
    public function __construct(ApplicationInterface $application, UserManagerInterface $articleManager)
    {
        parent::__construct($application, $articleManager);
    }

    /**
     * @Route({"/"}, name="user_index",  methods="GET")
     *
     * @param UserRepository $userRepository
     * @return Response
     */
    public function index(UserRepository $userRepository): Response
    {
        return $this->render('user/index.html.twig', ['users' => $userRepository->findAll()]);
    }

    /**
     * @Route({"cs": "/novy", "en": "/new"}, name="user_new", methods="GET|POST")
     *
     * @param Request $request
     * @param UserFactory $userFactory
     * @return Response
     */
    public function new(Request $request, UserFactory $userFactory): Response
    {
        $user = $userFactory->create();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        $created = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->createUser($user, true);    //validation execute on form layer
                $created = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $created === true
            ? $this->redirectToRoute('user_new')
            : $this->render('user/new.html.twig', ['user' => $user, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="user_show", methods="GET")
     *
     * @param User $user
     * @return Response
     */
    public function show(User $user): Response
    {
        return $this->render('user/show.html.twig', ['user' => $user]);
    }

    /**
     * @Route({"cs": "/{id}/upravit", "en": "/{id}/edit"}, name="user_edit", methods="GET|POST")
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function edit(Request $request, User $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('user_edit', ['id' => $user->getId()]);
        }

        return $this->render('user/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="user_delete", methods="DELETE")
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function delete(Request $request, User $user): Response
    {
        if($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($user);
            $em->flush();
        }

        return $this->redirectToRoute('user_index');
    }

    /**
     * @Route({"cs": "/prihlasit", "en": "/login"}, name="user_login")
     *
     * @param AuthenticationUtils $authenticationUtils
     * @return Response
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->render('user/login.html.twig', array(
            'last_username' => $authenticationUtils->getLastUsername(),    //last username entered by the user
            'error' => $authenticationUtils->getLastAuthenticationError(), //get the login error if there is one
        ));
    }

    /**
     * @Route({"cs": "/odhlasit", "en": "/logout"}, name="user_logout")
     *
     * @return Response
     */
    public function logout(): Response
    {
        $user = $this->getUser();
        if($user instanceof User) {//pktodo zlepsi hlasku + preklady

            $this->addFlash('success', sprintf('uživatel %s byl odhlášen', $user->getFullName()));
        }

        return $this->redirectToRoute('login');
    }


}
