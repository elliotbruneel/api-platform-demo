<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Review.
 *
 * @ORM\Table(name="review")
 * @ORM\Entity(repositoryClass="App\Repository\ReviewRepository")
 * @ApiResource()
 */
class Review
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
     * @ORM\Column(name="note", type="integer")
     */
    private $note;

    /**
     * @var string|null
     *
     * @ORM\Column(name="comment", type="string", length=255, nullable=true)
     */
    private $comment;

    /**
     * One review has One detail.
     *
     * @Assert\NotNull()
     * @ORM\OneToOne(targetEntity="App\Entity\CommandDetails", inversedBy="review")
     * @ORM\JoinColumn(name="detail_id", referencedColumnName="id")
     */
    private $detail;

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
     * Set note.
     *
     * @param int $note
     *
     * @return Review
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note.
     *
     * @return int
     */
    public function getNote()
    {
        return $this->note;
    }

    /**
     * Set comment.
     *
     * @param string|null $comment
     *
     * @return Review
     */
    public function setComment($comment = null)
    {
        $this->comment = $comment;

        return $this;
    }

    /**
     * Get comment.
     *
     * @return string|null
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set detail.
     *
     * @param CommandDetails $detail
     *
     * @return Review
     */
    public function setDetail(CommandDetails $detail = null)
    {
        $this->detail = $detail;

        return $this;
    }

    /**
     * Get detail.
     *
     * @return CommandDetails|null
     */
    public function getDetail()
    {
        return $this->detail;
    }
}
