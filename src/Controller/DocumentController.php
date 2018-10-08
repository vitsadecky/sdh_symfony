<?php

namespace App\Controller;

use App\ApplicationInterface;
use App\Entity\Document;
use App\Factory\DocumentFactory;
use App\Form\DocumentType;
use App\Manager\DocumentManagerInterface;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

/**
 * @method DocumentManagerInterface getManager()
 * @Route(
 *     {"cs": "{_locale}/dokument", "en": "/{_locale}/document"},
 *     defaults={"_locale": "cs"}, requirements={"_locale": "cs|en"}
 *     )
 */
class DocumentController extends AbstractAppController
{
    /**
     * DocumentController constructor.
     * @param ApplicationInterface $application
     * @param DocumentManagerInterface $documentManager
     */
    public function __construct(ApplicationInterface $application,
                                DocumentManagerInterface $documentManager)
    {
        parent::__construct($application, $documentManager);
    }

    /**
     * @Route("/", name="document_index", methods="GET")
     *
     * @return Response
     */
    public function index(): Response
    {
        $documents = [];
        try {
            $documents = $this->getManager()->getAllDocuments();
        } catch (\Throwable $throwable) {
            $this->getApplication()->handleError($throwable);
        }

        return $this->render('document/index.html.twig', ['documents' => $documents]);
    }

    /**
     * @Route({"cs": "/novy", "en": "/new"}, name="document_new", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Document")
     *
     * @param Request $request
     * @param DocumentFactory $documentFactory
     * @return Response
     */
    public function new(Request $request, DocumentFactory $documentFactory): Response
    {
        $document = $documentFactory->create($this->getUser());
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        $created = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->createDocument($document);    //validation execute on form layer
                $created = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $created === true
            ? $this->redirectToRoute('document_index')
            : $this->render('document/new.html.twig', ['document' => $document, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="document_show", methods="GET")
     * @ParamConverter("post", class="\App\Entity\Document")
     *
     * @param Document $document
     * @return Response
     */
    public function show(Document $document): Response
    {
        return $this->render('document/show.html.twig', ['document' => $document]);
    }

    /**
     * @Route({"cs": "/{id}/upravit", "en": "/{id}/edit"}, name="document_edit", methods="GET|POST")
     * @ParamConverter("post", class="\App\Entity\Document")
     *
     * @param Request $request
     * @param Document $document
     * @return Response
     */
    public function edit(Request $request, Document $document): Response
    {
        $form = $this->createForm(DocumentType::class, $document);
        $form->handleRequest($request);

        $edited = false;
        if($form->isSubmitted()) {  //submit form
            try {
                $this->getManager()->editDocument($document);    //validation execute on form layer
                $edited = true;
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $edited === true
            ? $this->redirectToRoute('document_index')
            : $this->render('document/edit.html.twig', ['document' => $document, 'form' => $form->createView()]);
    }

    /**
     * @Route("/{id}", name="document_delete", methods="DELETE")
     * @ParamConverter("post", class="\App\Entity\Document")
     *
     * @param Request $request
     * @param Document $document
     * @return Response
     */
    public function delete(Request $request, Document $document): Response
    {
        if($this->isCsrfTokenValid('delete' . $document->getId(), $request->request->get('_token'))) {
            try {
                $this->getManager()->deleteDocument($document);
            } catch (\Throwable $throwable) {
                $this->getApplication()->handleError($throwable);
            }
        }

        return $this->redirectToRoute('document_index');
    }
}
