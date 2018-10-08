<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Article
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article implements EntityInterface
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="article.title.notBlank")
     * @Assert\Length(max = 50 , maxMessage="The article title cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=50)
     */
    private $title;

    /**
     * @var string
     * @Assert\NotBlank(message="The content of the article is required")
     * @ORM\Column(type="blob")
     */
    private $content;

    /**
     * @var string
     * @ORM\Column(type="blob")
     */
    private $image;

    /**
     * pktodo always increase
     * @var int
     * @Assert\NotBlank(message="The article attendance is required")
     * @Assert\Type(type="integer", message="The attendance must by valid integer")
     * @ORM\Column(type="integer")
     */
    private $attendance;

    /**
     * pktodo always changes
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastVisitedAt;

    /**
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $publishedAt;

    /**
     * @var Category
     * @Assert\NotBlank(message="The category of the article is required")
     * @ORM\ManyToOne(targetEntity="Category", inversedBy="articles",  cascade = {"persist"})
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $category;

    /**
     * @var User
     * @Assert\NotBlank(message="The author of the article is required")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="articles",  cascade = {"persist"})
     */
    private $author;

    /**
     * @var ArrayCollection|Comment[]
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="article",  cascade = {"persist"})
     * @ORM\JoinColumn(name="article_id", referencedColumnName="id", onDelete="CASCADE")
     */
    private $comments;

    /**
     * Article constructor.
     */
    public function __construct()
    {
        $this->comments = new ArrayCollection();
    }

    /***
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return $this
     */
    public function setTitle(string $title): Article
    {
        $this->title = $title;
        return $this;
    }

    /**
     * @return string
     */
    public function getContent(): ?string
    {
        return $this->content !== null
            ? stream_get_contents($this->content)
            : null;
    }

    /**
     * @return string
     */
    public function getImage(): ?string
    {
        return $this->image !== null
            ? stream_get_contents($this->image)
            : null;
    }

    /**
     * @param string $image
     * @return Article
     */
    public function setImage(string $image): Article
    {
        $this->image = $image;
        return $this;
    }


    /**
     * @param mixed $content
     * @return Article
     */
    public function setContent($content): Article
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPublishedAt(): ?\DateTimeInterface
    {
        return $this->publishedAt;
    }

    /**
     * @param \DateTimeInterface|null $publishedAt
     * @return Article
     */
    public function setPublishedAt(?\DateTimeInterface $publishedAt): Article
    {
        $this->publishedAt = $publishedAt;
        return $this;
    }

    /**
     * @return Category|null
     */
    public function getCategory(): ?Category
    {
        return $this->category;
    }

    /**
     * @param Category $category
     * @return Article
     */
    public function setCategory(Category $category): Article
    {
        $this->category = $category;
        return $this;
    }

    /**
     * @return User|null
     */
    public function getAuthor(): ?User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Article
     */
    public function setAuthor(User $author): Article
    {
        $this->author = $author;
        return $this;
    }

    /**
     * @return Comment[]|ArrayCollection
     */
    public function getComments(): ArrayCollection
    {
        return $this->comments;
    }


    /**
     * @param Comment $comment
     * @return Article
     */
    public function addComment(Comment $comment): Article
    {
        if(!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setArticle($this);
        }

        return $this;
    }

    /**
     * @return int
     */
    public function getAttendance(): int
    {
        return $this->attendance ?? 0;
    }

    /**
     * @param int $attendance
     * @return Article
     */
    public function setAttendance(int $attendance): Article
    {
        $this->attendance = $attendance;
        return $this;
    }

    /**
     * Increase article traffic
     * @return Article
     */
    public function addAttendance(): Article
    {
        $this->attendance++;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastVisitedAt(): ?\DateTimeInterface
    {
        return $this->lastVisitedAt;
    }

    /**
     * @param \DateTimeInterface|null $visitedAt
     * @return Article
     */
    public function setLastVisitedAt(?\DateTimeInterface $visitedAt): Article
    {
        $this->lastVisitedAt = $visitedAt;
        return $this;
    }
}
