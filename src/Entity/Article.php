<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Article.
 *
 * @ORM\Table(name="article")
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 * @ApiResource()
 */
class Article
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="label", type="string", length=255)
     */
    private $label;

    /**
     * @var float
     *
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var int
     *
     * @ORM\Column(name="stock", type="integer")
     */
    private $stock;

    /**
     * Many Features have One Product.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Category", inversedBy="articles")
     * @ORM\JoinColumn(name="category_id", referencedColumnName="id")
     */
    private $category;

    /**
     * One product has many features. This is the inverse side.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CommandDetails", mappedBy="article")
     */
    private $commandDetails;

    public function __construct()
    {
        $this->commandDetails = new ArrayCollection();
    }

    public function __toString()
    {
        return 'ID : '.$this->id;
    }

    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set label.
     *
     * @param string $label
     *
     * @return Article
     */
    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    /**
     * Get label.
     *
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * Set price.
     *
     * @param float $price
     *
     * @return Article
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price.
     *
     * @return float
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set stock.
     *
     * @param int $stock
     *
     * @return Article
     */
    public function setStock($stock)
    {
        $this->stock = $stock;

        return $this;
    }

    /**
     * Get stock.
     *
     * @return int
     */
    public function getStock()
    {
        return $this->stock;
    }

    /**
     * Set category.
     *
     * @param Category $category
     *
     * @return Article
     */
    public function setCategory(Category $category = null)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category.
     *
     * @return Category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Add commandDetail.
     *
     * @param CommandDetails $commandDetail
     *
     * @return Article
     */
    public function addCommandDetail(CommandDetails $commandDetail)
    {
        $this->commandDetails[] = $commandDetail;

        return $this;
    }

    /**
     * Remove commandDetail.
     *
     * @param CommandDetails $commandDetail
     */
    public function removeCommandDetail(CommandDetails $commandDetail)
    {
        $this->commandDetails->removeElement($commandDetail);
    }

    /**
     * Get commandDetails.
     *
     * @return Collection
     */
    public function getCommandDetails()
    {
        return $this->commandDetails;
    }

    public function getAverageNote()
    {

        $total = 0;
        $nbr = 0;

        foreach ($this->commandDetails as $detail) {
            if ($detail->getReview()) {
                $total += $detail->getReview()->getNote();
                ++$nbr;
            }
        }

        if (0 == $nbr) {
            return 'X';
        } else {
            return $total / $nbr;
        }
    }
}
