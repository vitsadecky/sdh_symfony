<?php declare(strict_types=1);
/**
 * User: Vit Sadecky
 * Date: 9. 4. 2018
 * Time: 6:33
 */

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class Category
 * @package App\Entity
 * @ORM\Entity(repositoryClass="App\Repository\CategoryRepository")
 * @UniqueEntity("name")
 */
class Category implements EntityInterface
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
     * @Assert\NotBlank(message="The category name is required")
     * @Assert\Length(
     *      min = 5,
     *      max = 50 ,
     *      minMessage = "The category name must be at least {{ limit }} characters long",
     *      maxMessage="The category name cannot be longer than {{ limit }} characters" )
     * @ORM\Column(type="string", length=50)
     */
    private $name;

    /**
     * @var ArrayCollection|Article[]
     * @ORM\OneToMany(targetEntity="Article", mappedBy="category", cascade={"all"}, orphanRemoval=true)
     */
    private $articles;

    /**
     * Category constructor.
     */
    public function __construct()
    {
        $this->articles = new ArrayCollection();
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
     * @return Category
     */
    public function setName(?string $name): Category
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param Article $article
     * @return Category
     */
    public function addArticle(Article $article): Category
    {
        if(!$this->articles->contains($article)) {
            $this->articles->add($article);
            $article->setCategory($this);
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
}
