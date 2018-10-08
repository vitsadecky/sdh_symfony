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
 * Class Traffic
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\TrafficRepository")
 */
class Traffic implements EntityInterface
{
    /**
     * @var int|null
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var int
     * @Assert\NotBlank(message="The traffic attendance is required")
     * @Assert\Type(type="int", message="The attendance of pages is not valid integer")
     * @ORM\Column(type="integer")
     */
    private $attendance;

    /**
     * @var \DateTimeInterface|null
     * @Assert\DateTime()
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastVisitedAt;

    /**
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
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
     * @return Traffic
     */
    public function setAttendance(int $attendance): Traffic
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
     * @param \DateTimeInterface $visitedAt
     * @return Traffic
     */
    public function setLastVisitedAt(\DateTimeInterface $visitedAt): Traffic
    {
        $this->lastVisitedAt = $visitedAt;
        return $this;
    }
}
