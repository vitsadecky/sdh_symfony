<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Company: Software602 a.s.
 * Date: 1. 10. 2018
 * Time: 6:38
 */

namespace App\Event;

use App\Entity\Document;
use Symfony\Component\EventDispatcher\Event;

/**
 * Class DocumentEvent
 * @package App\Event
 */
class DocumentEvent extends Event
{
    public const
        CREATE_PRE = self::EVENT_PREFIX . '.createPre',
        CREATE_POST = self::EVENT_PREFIX . '.createPost',
        EDIT_PRE = self::EVENT_PREFIX . '.editPre',
        EDIT_POST = self::EVENT_PREFIX . '.editPost',
        DELETE_PRE = self::EVENT_PREFIX . '.deletePre',
        DELETE_POST = self::EVENT_PREFIX . '.deletePost';

    private const EVENT_PREFIX = 'document';


    /** @var Document */
    private $document;

    /**
     * UserEvent constructor.
     * @param Document $document
     */
    public function __construct(Document $document)
    {
        $this->document = $document;
    }

    /**
     * @return Document
     */
    public function getDocument(): Document
    {
        return $this->document;
    }
}