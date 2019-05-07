<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use ApiPlatform\Core\Annotation\ApiSubresource;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Secteur
 * @ApiResource()
 * @ORM\Table(name="secteur")
 * @ORM\Entity(repositoryClass="App\Repository\SecteurRepository")
 */
class Secteur
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
     * @ORM\Column(name="libelle", type="string", length=100, unique=true)
     */
    private $libelle;

    /**
     * @var ArrayCollection Structure $structures
     * Owning Side
     *
     * @ApiSubresource()
     * @ORM\ManyToMany(targetEntity="Structure", mappedBy="secteurs")
     * @ORM\JoinTable(name="secteurs_structures",
     *   joinColumns={@ORM\JoinColumn(name="id_secteur", referencedColumnName="id")},
     *   inverseJoinColumns={@ORM\JoinColumn(name="id_structure", referencedColumnName="id")}
     * )
     */
    private $structures;

    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set libelle
     *
     * @param string $libelle
     *
     * @return Secteur
     */
    public function setLibelle($libelle)
    {
        $this->libelle = $libelle;

        return $this;
    }

    /**
     * Get libelle
     *
     * @return string
     */
    public function getLibelle()
    {
        return $this->libelle;
    }

    /**
     * @return ArrayCollection
     */
    public function getStructures()
    {
        return $this->structures;
    }

    /**
     * @param ArrayCollection $structures
     */
    public function setStructures($structures)
    {
        $this->structures = $structures;
    }
}

