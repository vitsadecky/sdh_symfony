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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Class User
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("login", message="The Login is already used, please choose another one")
 */
class User implements UserInterface, \Serializable, EntityInterface
{
    /**
     * @var int|null
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string|null
     * @Assert\Length(
     *      min = 2,
     *      max = 30,
     *      minMessage = "The first name must be at least {{ limit }} characters long",
     *      maxMessage="The first name cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $firstName;

    /**
     * @var string|null
     * @Assert\Length(
     *      min = 2,
     *      max = 50,
     *      minMessage = "The surname must be at least {{ limit }} characters long",
     *      maxMessage="The surname cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $surname;

    /**
     * @var string|null
     * @Assert\Email()
     * @ORM\Column(type="string", length=60)
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank(message="The login name is required")
     * @Assert\Length(
     *      min = 4,
     *      max = 20,
     *      minMessage = "The login name must be at least {{ limit }} characters long",
     *      maxMessage="The login name cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=15)
     */
    private $login;

    /**
     * @var string|null
     * @Assert\NotBlank(message="The password is required")
     * @Assert\Length(
     *      min = 6,
     *      max = 64,
     *      minMessage = "The password must be at least {{ limit }} characters long",
     *      maxMessage="The password cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * @var string|null
     * @Assert\NotBlank(message="The language/locale is required")
     * @Assert\Language()
     * @ORM\Column(type="string", length=3)
     */
    private $language;

    /**
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $birthDate;

    /**
     * @var string|null
     * @Assert\NotBlank(message="The gender is required")
     * @Assert\Choice({"M", "Ž"}, message="The gender is invalid")
     * @ORM\Column(type="string", length=1)
     */
    private $gender;

    /**
     * @var bool
     * @Assert\NotBlank(message="The active flag of user is required")
     * @Assert\Type(type="bool")
     * @ORM\Column(type="boolean")
     */
    private $isActive;

    /**
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastLoggedAt;

    /**
     * @var ArrayCollection|Article[]
     * @ORM\OneToMany(targetEntity="Article", mappedBy="author",  cascade = {"persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", onDelete="CASCADE")
     */
    private $articles;

    /**
     * @var ArrayCollection|Post[]
     * @ORM\OneToMany(targetEntity="Post", mappedBy="author",  cascade = {"persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", onDelete="CASCADE")
     */
    private $posts;

    /**
     * @var ArrayCollection|Comment[]
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="author",  cascade = {"persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", onDelete="CASCADE")
     */
    private $comments;

    /**
     * @var ArrayCollection|Document[]
     * @ORM\OneToMany(targetEntity="Document", mappedBy="author",  cascade = {"persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", onDelete="CASCADE")
     */
    private $documents;

    /**
     * @var ArrayCollection|Event[]
     * @ORM\OneToMany(targetEntity="Event", mappedBy="author",  cascade = {"persist"})
     * @ORM\JoinColumn(name="id", referencedColumnName="author_id", onDelete="CASCADE")
     */
    private $events;

    /**
     * User constructor.
     * @param string|null $locale
     */
    public function __construct(string $locale = null)
    {
        $this->articles = new ArrayCollection();
        $this->posts = new ArrayCollection();
        $this->comments = new ArrayCollection();
        $this->documents = new ArrayCollection();
        $this->events = new ArrayCollection();

        $this->createdAt = new \DateTime();
        $this->isActive = true;
        $this->language = $locale;
    }


    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize(): string
    {
        return serialize(array(
            $this->id,
            $this->login,
            $this->password,
            // see section on salt below
            // $this->salt,
        ));
    }

    /** @see \Serializable::unserialize()
     * @param $serialized
     * @return void
     */
    public function unserialize($serialized): void
    {
        [
            $this->id,
            $this->login,
            $this->password,
            // see section on salt below
            // $this->salt
        ] = unserialize($serialized, array('allowed_classes' => false));
    }

    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getUsername(): ?string
    {
        return $this->login;
    }

    /**
     * not needed for apps that do not check user passwords
     * @return string
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    /**
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        return array('ROLE_USER');
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param string $firstName
     * @return User
     */
    public function setFirstName(string $firstName): User
    {
        $this->firstName = $firstName;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    /**
     * @param string $surname
     * @return User
     */
    public function setSurname(string $surname): User
    {
        $this->surname = $surname;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSurname(): ?string
    {
        return $this->surname;
    }

    /**
     * @param string $email
     * @return User
     */
    public function setEmail(string $email): User
    {
        $this->email = $email;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getEmail(): ?string
    {
        return $this->email;
    }

    /**
     * @param string $language
     * @return User
     */
    public function setLanguage(string $language): User
    {
        $this->language = $language;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLanguage(): ?string
    {
        return $this->language;
    }

    /**
     * @param string $login
     * @return User
     */
    public function setLogin(string $login): User
    {
        $this->login = $login;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getLogin(): ?string
    {
        return $this->login;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword(string $password): User
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @param \DateTimeInterface|null $createdAt
     * @return User
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): User
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface|null $birthDate
     * @return User
     */
    public function setBirthDate(?\DateTimeInterface $birthDate): User
    {
        $this->birthDate = $birthDate;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    /**
     * @param string $gender
     * @return User
     */
    public function setGender(string $gender): User
    {
        $this->gender = $gender;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getGender(): ?string
    {
        return $this->gender;
    }

    /**
     * @param bool $isActive
     * @return User
     */
    public function setIsActive(bool $isActive): User
    {
        $this->isActive = $isActive;
        return $this;
    }

    /**
     * @return bool
     */
    public function isActive(): bool
    {
        return $this->isActive ?? false;
    }

    /**
     * @param \DateTimeInterface|null $lastLoggedAt
     * @return User
     */
    public function setLastLoggedAt(?\DateTimeInterface $lastLoggedAt): User
    {
        $this->lastLoggedAt = $lastLoggedAt;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getLastLoggedAt(): ?\DateTimeInterface
    {
        return $this->lastLoggedAt;
    }


    /**
     * @param Article $article
     * @return $this
     */
    public function addArticle(Article $article): User
    {
        if(!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setAuthor($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Article[]
     */
    public function getArticles(): ArrayCollection
    {
        return $this->articles;
    }

    /**
     * @param Post $post
     * @return $this
     */
    public function addPost(Post $post): User
    {
        if(!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setAuthor($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Post[]
     */
    public function getPosts(): ArrayCollection
    {
        return $this->posts;
    }

    /**
     * @param Comment $comment
     * @return $this
     */
    public function addComment(Comment $comment): User
    {
        if(!$this->comments->contains($comment)) {
            $this->comments->add($comment);
            $comment->setAuthor($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Comment[]
     */
    public function getComments(): ArrayCollection
    {
        return $this->comments;
    }

    /**
     * @param Document $document
     * @return $this
     */
    public function addDocument(Document $document): User
    {
        if(!$this->documents->contains($document)) {
            $this->documents->add($document);
            $document->setAuthor($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Document[]
     */
    public function getDocuments(): ArrayCollection
    {
        return $this->documents;
    }

    /**
     * @param Event $event
     * @return User
     */
    public function addEvent(Event $event): User
    {
        if(!$this->events->contains($event)) {
            $this->events->add($event);
            $event->setAuthor($this);
        }

        return $this;
    }

    /**
     * @return ArrayCollection|Event[]
     */
    public function getEvents(): ArrayCollection
    {
        return $this->events;
    }


    /**
     * Returns the username used to authenticate the user.
     *
     * @return string The username
     */
    public function getFullName(): string
    {
        $userName = [];
        $userName[] = $this->firstName;
        $userName[] = $this->surname;

        return implode(' ', array_filter($userName));
    }

}