<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Entity\Gallery;
use App\Factory\GalleryFactory;
use App\Form\GalleryType;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use App\Manager\GalleryManagerInterface;

/**
 * @method GalleryManagerInterface getManager()
 * @Route(
 *     {"cs": "{_locale}/galerie", "en": "/{_locale}/gallery"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class GalleryController extends AbstractAppController
{
    /**
     * GalleryController constructor.
     * @param ApplicationInterface $application
     * @param GalleryManagerInterface $galleryManager
     */
    public function __construct(ApplicationInterface $application, GalleryManagerInterface $galleryManager)
    {
        parent::__construct($application, $galleryManager);
    }

    /**
     * @Route("/", name="gallery_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $gallery = [];
        try {
            $gallery = $this->getManager()->getWholeGallery();
        } catch (\Throwable $throwable) {
            $this->getApplication()->handleError($throwable);
        }

        return $this->render('gallery/index.html.twig', ['gallery' => $gallery]);
    }

    /**
     * @Route({"cs": "/novy", "en": "/new"}, name="gallery_new", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Gallery")
     *
     * @param Request $request
     * @param GalleryFactory $galleryFactory
     * @return Response
     */
    public function new(Request $request, GalleryFactory $galleryFactory): Response
    {
        $gallery = $galleryFactory->create($this->getUser());
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        $created = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->createGallery($gallery);    //validation execute on form layer
                $created = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $created === true
            ? $this->redirectToRoute('gallery_index')
            : $this->render('gallery/new.html.twig', ['gallery' => $gallery, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="gallery_show", methods="GET")
     * @ParamConverter("post", class="\App\Entity\Gallery")
     *
     * @param Gallery $gallery
     * @return Response
     */
    public function show(Gallery $gallery): Response
    {
        return $this->render('gallery/show.html.twig', ['gallery' => $gallery]);
    }

    /**
     * @Route({"cs": "/{id}/upravit", "en": "/{id}/edit"}, name="gallery_edit", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Gallery")
     *
     * @param Request $request
     * @param Gallery $gallery
     * @return Response
     */
    public function edit(Request $request, Gallery $gallery): Response
    {
        $form = $this->createForm(GalleryType::class, $gallery);
        $form->handleRequest($request);

        $edited = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->editGallery($gallery);    //validation execute on form layer
                $edited = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $edited === true
            ? $this->redirectToRoute('gallery_index')
            : $this->render('gallery/edit.html.twig', ['gallery' => $gallery, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="gallery_delete", methods="DELETE")
     * @ParamConverter("post", class="\App\Entity\Gallery")
     *
     * @param Request $request
     * @param Gallery $gallery
     * @return Response
     */
    public function delete(Request $request, Gallery $gallery): Response
    {
        if($this->isCsrfTokenValid('delete' . $gallery->getId(), $request->request->get('_token'))) {
            try {
                $this->getManager()->deleteGallery($gallery);
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $this->redirectToRoute('gallery_index');
    }
}
