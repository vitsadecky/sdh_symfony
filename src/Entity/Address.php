<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use App\Validator\Constraints as CustomAssert;

/**
 * Class Subject
 * @package App\Entity
 * @ORM\Entity
 */
class Address implements EntityInterface
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
     * @Assert\NotBlank(message="The street name is required")
     * @Assert\Length(max = 80 , maxMessage="The street name cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=80)
     */
    private $street;

    /**
     * @var string
     * @Assert\NotBlank(message="The city name is required")
     * @Assert\Length(max = 40 , maxMessage="The city cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=40)
     */
    private $city;

    /**
     * @var string
     * @Assert\Type(type="integer", message="The house number must be number")
     * @ORM\Column(type="integer", nullable=true)
     */
    private $houseNumber;

    /**
     * @var Subject
     * @ORM\OneToOne(targetEntity="Subject", inversedBy="address", cascade={"all"}, orphanRemoval=true)
     */
    private $subject;

    /**
     * @var string
     * @Assert\NotBlank(message="The zip code is required")
     * @CustomAssert\ZipCode()
     * @ORM\Column(type="integer", length=5)
     */
    private $zipCode;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Address
     */
    public function setId(?int $id): Address
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getStreet(): string
    {
        return $this->street;
    }

    /**
     * @param string $street
     * @return Address
     */
    public function setStreet(string $street): Address
    {
        $this->street = $street;
        return $this;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     * @return Address
     */
    public function setCity(string $city): Address
    {
        $this->city = $city;
        return $this;
    }

    /**
     * @return string
     */
    public function getHouseNumber(): string
    {
        return $this->houseNumber;
    }

    /**
     * @param string $houseNumber
     * @return Address
     */
    public function setHouseNumber(string $houseNumber): Address
    {
        $this->houseNumber = $houseNumber;
        return $this;
    }

    /**
     * @return string
     */
    public function getZipCode(): string
    {
        return $this->zipCode;
    }

    /**
     * @param string $zipCode
     * @return Address
     */
    public function setZipCode(string $zipCode): Address
    {
        $this->zipCode = $zipCode;
        return $this;
    }

    /**
     * @return Subject
     */
    public function getSubject(): Subject
    {
        return $this->subject;
    }

    /**
     * @param Subject $subject
     * @return Address
     */
    public function setSubject(Subject $subject): Address
    {
        $this->subject = $subject;
        return $this;
    }
}
