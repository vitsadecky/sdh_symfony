<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Entity\Category;
use App\Factory\CategoryFactory;
use App\Form\CategoryType;
use App\Manager\CategoryManagerInterface;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @method CategoryManagerInterface getManager()
 *
 * @Route(
 *     {"cs": "{_locale}/kategorie", "en": "/{_locale}/category"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class CategoryController extends AbstractAppController
{
    /**
     * CategoryController constructor.
     * @param ApplicationInterface $application
     * @param CategoryManagerInterface $categoryManager
     */
    public function __construct(ApplicationInterface $application, CategoryManagerInterface $categoryManager)
    {
        parent::__construct($application, $categoryManager);
    }

    /**
     * @Route("/", name="category_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $category = [];
        try {
            $category = $this->getManager()->getAllCategories();
        } catch (\Throwable $throwable) {
            $this->getApplication()->handleError($throwable);
        }

        return $this->render('category/index.html.twig', ['categories' => $category]);
    }

    /**
     * @Route({"cs": "/novy", "en": "/new"}, name="category_new", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Category")
     *
     * @param Request $request
     * @param CategoryFactory $categoryFactory
     * @return Response
     */
    public function new(Request $request, CategoryFactory $categoryFactory): Response
    {
        $category = $categoryFactory->create();
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        $created = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->createCategory($category);    //validation execute on form layer
                $created = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $created === true
            ? $this->redirectToRoute('category_index')
            : $this->render('category/new.html.twig', ['category' => $category, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="category_show", methods="GET")
     * @ParamConverter("post", class="\App\Entity\Category")
     *
     * @param Category $category
     * @return Response
     */
    public function show(Category $category): Response
    {
        return $this->render('category/show.html.twig', ['category' => $category]);
    }

    /**
     * @Route({"cs": "/{id}/upravit", "en": "/{id}/edit"}, name="category_edit", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Category")
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function edit(Request $request, Category $category): Response
    {
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        $edited = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->editCategory($category);    //validation execute on form layer
                $edited = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $edited === true
            ? $this->redirectToRoute('category_index')
            : $this->render('category/edit.html.twig', ['category' => $category, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="category_delete", methods="DELETE")
     * @ParamConverter("post", class="\App\Entity\Category")
     *
     * @param Request $request
     * @param Category $category
     * @return Response
     */
    public function delete(Request $request, Category $category): Response
    {
        if($this->isCsrfTokenValid('delete' . $category->getId(), $request->request->get('_token'))) {
            try {
                $this->getManager()->deleteCategory($category);
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $this->redirectToRoute('category_index');
    }
}
