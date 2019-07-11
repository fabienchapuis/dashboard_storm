<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\EvenementRepository")
 */
class Evenement
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $lieux;

    /**
     * 
     */
    private $presence;

    /**
     * @ORM\Column(type="integer", nullable=true, length=5)
     */
    private $nbenfants;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $distance;

    /***
     * @ORM\ManyToOne(targetEntity="App\Entity\Saison", mappedBy ="evenements")
     * 
     * 
     */
    private $saisons;

    /**
     * 
     * @ORM\OneToMany(targetEntity="App\Entity\Reponse", mappedBy ="evenements"  )
     * 
     */
    private $presences;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $precense;

    public function __construct()
    {
        $this->presence = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getLieux(): ?string
    {
        return $this->lieux;
    }

    public function setLieux(string $lieux): self
    {
        $this->lieux = $lieux;

        return $this;
    }

    /**
     * @return Collection|reponse[]
     */
    public function getPresence(): Collection
    {
        return $this->presence;
    }

    public function addPresence(reponse $presence): self
    {
        if (!$this->presence->contains($presence)) {
            $this->presence[] = $presence;
            $presence->setEvenement($this);
        }

        return $this;
    }

    public function removePresence(reponse $presence): self
    {
        if ($this->presence->contains($presence)) {
            $this->presence->removeElement($presence);
            // set the owning side to null (unless already changed)
            if ($presence->getEvenement() === $this) {
                $presence->setEvenement(null);
            }
        }

        return $this;
    }

    public function getNbenfants(): ?int
    {
        return $this->nbenfants;
    }

    public function setNbenfants(?int $nbenfants): self
    {
        $this->nbenfants = $nbenfants;

        return $this;
    }

    public function getDistance(): ?int
    {
        return $this->distance;
    }

    public function setDistance(?int $distance): self
    {
        $this->distance = $distance;

        return $this;
    }

    public function getPrecense(): ?string
    {
        return $this->precense;
    }

    public function setPrecense(string $precense): self
    {
        $this->precense = $precense;

        return $this;
    }
}
