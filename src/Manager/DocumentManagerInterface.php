<?php declare(strict_types=1);
/**
 * Document: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 2. 10. 2018
 * Time: 6:53
 */


namespace App\Manager;

use App\Entity\Document;

/**
 * Interface DocumentManagerInterface
 * @package App\Manager
 */
interface DocumentManagerInterface extends ManagerInterface
{
    /**
     * @param Document $Document
     * @return DocumentManagerInterface
     */
    public function createDocument(Document $Document): DocumentManagerInterface;

    /**
     * @param Document $document
     * @return DocumentManagerInterface
     */
    public function editDocument(Document $document): DocumentManagerInterface;

    /**
     * @param Document $document
     * @return DocumentManagerInterface
     */
    public function deleteDocument(Document $document): DocumentManagerInterface;

    /**
     * @return Document[]
     */
    public function getAllDocuments(): array;
}