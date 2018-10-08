<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:39
 */

namespace App\Event\Factory;

use App\Entity\Document;
use App\Event\DocumentEvent;

/**
 * Class DocumentEventFactory
 * @package App\Event\Factory
 */
class DocumentEventFactory
{
    /**
     * @param Document $document
     * @return DocumentEvent
     */
    public function create(Document $document): DocumentEvent
    {
        return new DocumentEvent($document);
    }
}