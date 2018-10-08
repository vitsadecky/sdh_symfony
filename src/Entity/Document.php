<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Document
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\DocumentRepository")
 */
class Document implements EntityInterface
{
    /**
     * @var int
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @Assert\NotBlank(message="The document name is required")
     * @Assert\Length(max = 80 , maxMessage="The document name cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=80)
     */
    private $name;

    /**
     * @var User
     * @Assert\NotBlank(message="Author is required")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="documents",  cascade = {"persist"})
     */
    private $author;

    /**
     * @var float
     * @Assert\NotBlank(message="The file size is required")
     * @Assert\Type(type="float")
     * @ORM\Column(type="float")
     */
    private $size;

    /**
     * @Assert\DateTime()
     * @var \DateTimeInterface
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var string|null
     * @Assert\Length(max = 255 , maxMessage="The description of file cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $description;

    /**
     * @var string
     * @Assert\NotBlank(message="The document content is required")
     * @ORM\Column(type="blob")
     */
    private $content;

    /**
     * @var string
     * @Assert\NotBlank(message="The file name is required")
     * @Assert\Length(
     *     min = 2,
     *     max = 100,
     *     minMessage = "The file name name must be at least {{ limit }} characters long",
     *     maxMessage="The file name cannot be longer than {{ limit }} characters"
     * )
     * @ORM\Column(type="string", length=100)
     */
    private $fileName;

    /**
     * @var string
     * @Assert\NotBlank(message="The file extension is required")
     * @Assert\Length(max = 10 , maxMessage="The file extension cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=10)
     */
    private $extension;

    /**
     * pktodo musi byt navysovano kazdym stazenim dokumentu
     * @var int
     * @Assert\NotBlank(message="The total number of downloads is required")
     * @Assert\Type(type="integer", message="The total downloaded document must by valid integer")
     * @ORM\Column(type="integer")
     */
    private $downloaded;

    /**
     * Document constructor.
     * @param UserInterface $author
     */
    public function __construct(UserInterface $author)
    {
        $this->author = $author;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param null|string $name
     * @return Document
     */
    public function setName(?string $name): Document
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return null|User
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User $user
     * @return Document
     */
    public function setAuthor(User $user): Document
    {
        $this->author = $user;

        return $this;
    }

    /**
     * @return null|float
     */
    public function getSize(): ?float
    {
        return $this->size;
    }

    /**
     * @param float $size
     * @return Document
     */
    public function setSize(float $size): Document
    {
        $this->size = $size;

        return $this;
    }

    /**
     * @return null|string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return Document
     */
    public function setDescription(?string $description): Document
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     * @return Document
     */
    public function setContent(string $content): Document
    {
        $this->content = $content;

        return $this;
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return $this->fileName;
    }

    /**
     * @param string $fileName
     * @return Document
     */
    public function setFileName(string $fileName): Document
    {
        $this->fileName = $fileName;

        return $this;
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        return $this->extension;
    }

    /**
     * @param string $extension
     * @return Document
     */
    public function setExtension(string $extension): Document
    {
        $this->extension = $extension;

        return $this;
    }

    /**
     * @return \DateTimeInterface
     */
    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     * @return Document
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): Document
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return int
     */
    public function getDownloaded(): int
    {
        return $this->downloaded;
    }

    /**
     * @param int $downloaded
     * @return Document
     */
    public function setDownloaded(int $downloaded): Document
    {
        $this->downloaded = $downloaded;
        return $this;
    }
}
