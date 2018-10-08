<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Entity\Article;
use App\Factory\ArticleFactory;
use App\Form\ArticleType;
use App\Manager\ArticleManagerInterface;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @method ArticleManagerInterface getManager()
 * @Route(
 *     {"cs": "{_locale}/clanek", "en": "/{_locale}/article"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class ArticleController extends AbstractAppController
{
    /**
     * ArticleController constructor.
     * @param ApplicationInterface $application
     * @param ArticleManagerInterface $articleManager
     */
    public function __construct(ApplicationInterface $application,
                                ArticleManagerInterface $articleManager)
    {
        parent::__construct($application, $articleManager);
    }

    /**
     * @Route("/", name="article_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $articles = [];
        try {
            $articles = $this->getManager()->getAllArticles();
        } catch (\Throwable $throwable) {
            $this->getApplication()->handleError($throwable);
        }

        return $this->render('article/index.html.twig', ['articles' => $articles]);
    }

    /**
     * @Route({"cs": "/novy", "en": "/new"}, name="article_new", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Article")
     *
     * @param Request $request
     * @param ArticleFactory $articleFactory
     * @return Response
     */
    public function new(Request $request, ArticleFactory $articleFactory): Response
    {
        $article = $articleFactory->create();
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        $created = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->createArticle($article);    //validation execute on form layer
                $created = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $created === true
            ? $this->redirectToRoute('article_index')
            : $this->render('article/new.html.twig', ['article' => $article, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="article_show", methods="GET")
     * @ParamConverter("post", class="\App\Entity\Article")
     *
     * @param Article $article
     * @return Response
     */
    public function show(Article $article): Response
    {
        try {
            $article
                ->addAttendance()
                ->setLastVisitedAt(new \DateTime());

            $this->getManager()->editArticle($article);
        } catch (\Throwable $throwable) {
            $this->getApplication()->handleError($throwable);
        }

        return $this->render('article/show.html.twig', ['article' => $article]);
    }

    /**
     * @Route({"cs": "/{id}/upravit", "en": "/{id}/edit"}, name="article_edit", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Article")
     *
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function edit(Request $request, Article $article): Response
    {
        $form = $this->createForm(ArticleType::class, $article);
        $form->handleRequest($request);

        $edited = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->editArticle($article);    //validation execute on form layer
                $edited = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $edited === true
            ? $this->redirectToRoute('article_index')
            : $this->render('article/edit.html.twig', ['article' => $article, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="article_delete", methods="DELETE")
     * @ParamConverter("post", class="\App\Entity\Article")
     *
     * @param Request $request
     * @param Article $article
     * @return Response
     */
    public function delete(Request $request, Article $article): Response
    {
        if($this->isCsrfTokenValid('delete' . $article->getId(), $request->request->get('_token'))) {
            try {
                $this->getManager()->deleteArticle($article);
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $this->redirectToRoute('article_index');
    }
}
