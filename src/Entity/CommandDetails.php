<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * CommandDetails.
 *
 * @ORM\Table(name="command_details")
 * @ORM\Entity(repositoryClass="App\Repository\CommandDetailsRepository")*
 * @UniqueEntity(fields={"command.client", "article"}, message="error.sameUserAndApplication")
 * @ApiResource()
 */
class CommandDetails
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
     * @var int
     *
     * @ORM\Column(name="quantity", type="integer")
     */
    private $quantity;

    /**
     * Many Details have One Command.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Command", inversedBy="details")
     * @ORM\JoinColumn(name="command_id", referencedColumnName="id")
     */
    private $command;

    /**
     * Many Details have One Article.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Article", inversedBy="commandDetails")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $article;

    /**
     * One detail can have one review.
     *
     * @ORM\OneToOne(targetEntity="App\Entity\Review", mappedBy="detail")
     */
    private $review;

    /**
     * @ORM\Column(name="price", type="integer")
     *
     * @var int
     */
    private $price;

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
     * Set quantity.
     *
     * @param int $quantity
     *
     * @return CommandDetails
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;

        return $this;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param int $price
     *
     * @return CommandDetails
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get quantity.
     *
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * Set command.
     *
     * @param Command $command
     *
     * @return CommandDetails
     */
    public function setCommand(Command $command = null)
    {
        $this->command = $command;
        $this->command->addDetail($this);

        /*if(!$command->getDetails()->contains($this)){
        }*/

        return $this;
    }

    /**
     * Get command.
     *
     * @return Command
     */
    public function getCommand()
    {
        return $this->command;
    }

    /**
     * Set article.
     *
     * @param Article $article
     *
     * @return CommandDetails
     */
    public function setArticle(Article $article = null)
    {
        $this->article = $article;
        $this->price = $article->getPrice();

        return $this;
    }

    /**
     * Get article.
     *
     * @return Article
     */
    public function getArticle()
    {
        return $this->article;
    }

    public function getTotal()
    {
        return $this->price * $this->quantity;
    }

    /**
     * Set review.
     *
     * @param Review|null $review
     *
     * @return CommandDetails
     */
    public function setReview(Review $review = null)
    {
        $this->review = $review;

        return $this;
    }

    /**
     * Get review.
     *
     * @return Review|null
     */
    public function getReview()
    {
        return $this->review;
    }
}
