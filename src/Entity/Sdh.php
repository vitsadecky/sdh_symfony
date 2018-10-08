<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Class Article
 * pktodo dokoncit
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Sdh implements EntityInterface
{
    /**
     * pktodo dokoncit
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
     * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Sdh
     */
    public function setId(?int $id): Sdh
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @param string $title
     * @return Sdh
     */
    public function setTitle(string $title): Sdh
    {
        $this->title = $title;
        return $this;
    }


}
