<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 *
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Comment
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CommentRepository")
 */
class Comment implements EntityInterface
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
     * @Assert\NotBlank(message="The post content is required")
     * @ORM\Column(type="blob")
     */
    private $content;

    /**
     * @var \DateTimeInterface|null
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $commentedAt;

    /**
     * @var User
     * @Assert\NotBlank(message="Author is required")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="comments",  cascade = {"persist"})
     */
    private $author;

    /**
     * @var Article
     * @ORM\ManyToOne(targetEntity="Article", inversedBy="comments",  cascade = {"persist"})
     */
    private $article;

    /**
     * Comment constructor.
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->author = $user;
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getPostedAt(): ?\DateTimeInterface
    {
        return $this->commentedAt;
    }

    /**
     * @param \DateTimeInterface $commentedAt
     * @return Comment
     */
    public function setCommentedAt(?\DateTimeInterface $commentedAt): Comment
    {
        $this->commentedAt = $commentedAt;

        return $this;
    }

    /**
     * @return User
     */
    public function getUser(): User
    {
        return $this->author;
    }

    /**
     * @param User $user
     * @return Comment
     */
    public function setUser(User $user): Comment
    {
        $this->author = $user;
        return $this;
    }

    /**
     * @return Article
     */
    public function getArticle(): Article
    {
        return $this->article;
    }

    /**
     * @param Article $article
     * @return Comment
     */
    public function setArticle(Article $article): Comment
    {
        $this->article = $article;
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
     * @return Comment
     */
    public function setContent(string $content): Comment
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor(): User
    {
        return $this->author;
    }

    /**
     * @param User $author
     * @return Comment
     */
    public function setAuthor(User $author): Comment
    {
        $this->author = $author;
        return $this;
    }
}
