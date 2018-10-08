<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 14:48
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Post
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\PostRepository")
 */
class Post implements EntityInterface
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
     * @Assert\NotBlank(message="The post datetime is required")
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     */
    private $postedAt;

    /**
     * pktodo musi byt navysovano kazdym pristupem
     * @var int
     * @Assert\Type(type="integer", message="The attendance must by valid integer")
     * @ORM\Column(type="integer")
     */
    private $attendance;

    /**
     * pktodo musi byt navysovano kazdym pristupem
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastVisitedAt;

    /**
     * @var User
     * @Assert\NotBlank(message="Author is required")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="posts",  cascade = {"persist"})
     */
    private $author;

    /**
     * @var Forum
     * @Assert\NotBlank(message="The forum is required")
     * @ORM\ManyToOne(targetEntity="Forum", inversedBy="posts",  cascade = {"persist"})
     */
    private $forum;

    /**
     * Post constructor.
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
        return $this->postedAt;
    }

    /**
     * @param \DateTimeInterface $postedAt
     * @return Post
     */
    public function setPostedAt(?\DateTimeInterface $postedAt): Post
    {
        $this->postedAt = $postedAt;

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
     * @param User $user
     * @return Post
     */
    public function setAuthor(User $user): Post
    {
        $this->author = $user;
        return $this;
    }

    /**
     * @return Forum
     */
    public function getForum(): Forum
    {
        return $this->forum;
    }

    /**
     * @param Forum $forum
     * @return Post
     */
    public function setForum(Forum $forum): Post
    {
        $this->forum = $forum;
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
     * @return Post
     */
    public function setContent(string $content): Post
    {
        $this->content = $content;
        return $this;
    }

    /**
     * @return int
     */
    public function getAttendance(): int
    {
        return $this->attendance;
    }

    /**
     * @param int $attendance
     * @return Post
     */
    public function setAttendance(int $attendance): Post
    {
        $this->attendance = $attendance;
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
     * @return Post
     */
    public function setLastVisitedAt(?\DateTimeInterface $visitedAt): Post
    {
        $this->lastVisitedAt = $visitedAt;
        return $this;
    }
}
