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

/**
 * Class Forum
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ForumRepository")
 * @UniqueEntity("name")
 */
class Forum implements EntityInterface
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     * @Assert\NotBlank(message="The forum name is required")
     * @Assert\Length(
     *      min = 5,
     *      max = 50,
     *      minMessage = "The forum name must be at least {{ limit }} characters long",
     *      maxMessage="The forum name cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var ArrayCollection|Post[]
     * @ORM\OneToMany(targetEntity="Post", mappedBy="forum", cascade={"all"}, orphanRemoval=true)
     */
    private $posts;

    /**
     * Forum constructor.
     */
    public function __construct()
    {
        $this->posts = new ArrayCollection();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }


    /**
     * @return null|string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Forum
     */
    public function setName(?string $name): Forum
    {
        $this->name = $name;

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
     * @param \DateTimeInterface $createdAt
     * @return Forum
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): Forum
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @param Post $post
     * @return Forum
     */
    public function addPost(Post $post): Forum
    {
        if(!$this->posts->contains($post)) {
            $this->posts->add($post);
            $post->setForum($this);
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
}
