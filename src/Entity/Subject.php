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
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Subject
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\SubjectRepository")
 * @UniqueEntity("code", message="The subject code is is already in use")
 */
class Subject implements EntityInterface
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
     * @Assert\NotBlank(message="The subject code is required")
     * @Assert\Length(max = 10 , maxMessage="The subject code cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=10)
     */
    private $code;

    /**
     * @var string
     * @Assert\NotBlank(message="The subject name is required")
     * @Assert\Length(max = 50 , maxMessage="The subject code cannot be longer than {{ limit }} characters" )
     */
    private $name;

    /**
     * @var string
     * @Assert\Length(max = 255 , maxMessage="The description of subject cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=255)
     */
    private $description;

    /**
     * @var Address
     * @Assert\NotBlank(message="The address is required")
     * @Assert\Valid()
     * @ORM\OneToOne(targetEntity="Address", mappedBy="subject", cascade={"all"}, orphanRemoval=true)
     */
    private $address;

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
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @param string $code
     * @return Subject
     */
    public function setCode(string $code): Subject
    {
        $this->code = $code;
        return $this;
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
     * @return Subject
     */
    public function setName(string $name): Subject
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }

    /**
     * @param Address $address
     * @return Subject
     */
    public function setAddress(Address $address): Subject
    {
        $this->address = $address;
        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     * @return Subject
     */
    public function setDescription(string $description): Subject
    {
        $this->description = $description;
        return $this;
    }
}

