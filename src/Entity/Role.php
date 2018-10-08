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
 * Class Role
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\RoleRepository")
 */
class Role implements EntityInterface
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string|null
     * @Assert\NotBlank(message="The role type is required")
     * @Assert\Choice({"App\Manager\RoleManager", "getRoles"}, message="The role type is invalid")
     * @ORM\Column(type="string", length=15)
     */
    private $type;

    /**
     * @var ArrayCollection|User[]
     * @ORM\OneToMany(targetEntity="User", mappedBy="role", cascade={"all"}, orphanRemoval=true)
     */
    private $users;

    /**
     * Role constructor.
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
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
    public function getType(): ?string
    {
        return $this->type;
    }

    /**
     * @param string $type
     * @return Role
     */
    public function setType(string $type): Role
    {
        $this->type = $type;

        return $this;
    }

    /**
     * @param User $user
     * @return Role
     */
    public function addUser(User $user): Role
    {
        if(!$this->users->contains($user)) {
            $this->users->add($user);
            //$user->setRole($this); //pktodo to je otazka, jak to bude s rolemi
        }

        return $this;
    }
}
