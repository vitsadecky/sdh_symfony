<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 14:48
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Gallery
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\GalleryRepository")
 */
class Gallery implements EntityInterface
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
     * @Assert\NotBlank(message="The gallery name name is required")
     * @Assert\Length(
     *      min = 5,
     *      max = 50 ,
     *      minMessage = "The category name must be at least {{ limit }} characters long",
     *      maxMessage="The category name cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var float
     * @Assert\Type(type="float", message="The gallery latitude should be of type {{ type }}")
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude;

    /**
     * pktodo pak budu zobrazovat google mapu ve slideru
     * @var float
     * @Assert\Type(type="float", message="The gallery longitude should be of type {{ type }}")
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude;

    /**
     * @var \DateTimeInterface|null
     * @Assert\NotBlank(message="The date and time of gallery is required")
     * @Assert\DateTime()
     * @ORM\Column(type="datetime")
     */
    private $dateTime;

    /**
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $createdAt;

    /**
     * @var User
     * @Assert\NotBlank(message="Author is required")
     * @ORM\ManyToOne(targetEntity="User", inversedBy="gallerys",  cascade = {"persist"})
     */
    private $author;

    /**
     * Post constructor.
     * @param UserInterface $user
     */
    public function __construct(UserInterface $user)
    {
        $this->author = $user;
        $this->createdAt = new \DateTime();
    }

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return Gallery
     */
    public function setName(string $name): Gallery
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return float
     */
    public function getLatitude(): float
    {
        return $this->latitude;
    }

    /**
     * @param float $latitude
     * @return Gallery
     */
    public function setLatitude(float $latitude): Gallery
    {
        $this->latitude = $latitude;
        return $this;
    }

    /**
     * @return float
     */
    public function getLongitude(): float
    {
        return $this->longitude;
    }

    /**
     * @param float $longitude
     * @return Gallery
     */
    public function setLongitude(float $longitude): Gallery
    {
        $this->longitude = $longitude;
        return $this;
    }

    /**
     * @return \DateTimeInterface|null
     */
    public function getDateTime(): ?\DateTimeInterface
    {
        return $this->dateTime;
    }

    /**
     * @param \DateTimeInterface|null $dateTime
     * @return Gallery
     */
    public function setDateTime(?\DateTimeInterface $dateTime): Gallery
    {
        $this->dateTime = $dateTime;
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
     * @param \DateTimeInterface|null $createdAt
     * @return Gallery
     */
    public function setCreatedAt(?\DateTimeInterface $createdAt): Gallery
    {
        $this->createdAt = $createdAt;
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
     * @return Gallery
     */
    public function setAuthor(User $author): Gallery
    {
        $this->author = $author;
        return $this;
    }
}
