<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Command.
 *
 * @ORM\Table(name="command")
 * @ORM\Entity(repositoryClass="App\Repository\CommandRepository")
 * @ApiResource()
 */
class Command
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @var bool
     *
     * @ORM\Column(name="isValidated", type="boolean", nullable=true)
     */
    private $isValidated = false;

    /**
     * One Command has Many Products.
     *
     * @ORM\OneToMany(targetEntity="App\Entity\CommandDetails", mappedBy="command", cascade={"persist"})
     */
    private $details;

    /**
     * Many Commands have One Client.
     *
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="commands")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->details = new ArrayCollection();
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
     * Set date.
     *
     * @param \DateTime $date
     *
     * @return Command
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set isValidated.
     *
     * @param bool $isValidated
     *
     * @return Command
     */
    public function setIsValidated($isValidated)
    {
        $this->isValidated = $isValidated;

        return $this;
    }

    /**
     * Get isValidated.
     *
     * @return bool
     */
    public function getIsValidated()
    {
        return $this->isValidated;
    }

    /**
     * Add detail.
     *
     * @param CommandDetails $detail
     *
     * @return Command
     */
    public function addDetail(CommandDetails $detail)
    {
        $this->details[] = $detail;
        /*if($detail->getCommand() !== $this){
            $detail->setCommand($this);
        }*/

        return $this;
    }

    /**
     * Remove detail.
     *
     * @param CommandDetails $detail
     */
    public function removeDetail(CommandDetails $detail)
    {
        $this->details->removeElement($detail);
    }

    /**
     * Get details.
     *
     * @return Collection
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set client.
     *
     * @param Client $client
     *
     * @return Command
     */
    public function setClient(Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client.
     *
     * @return Client
     */
    public function getClient()
    {
        return $this->client;
    }

    public function getTotal()
    {
        $total = 0;
        /** @var CommandDetails $detail */
        foreach ($this->getDetails() as $detail) {
            $total += ($detail->getQuantity() * $detail->getPrice());
        }

        return $total;
    }
}
