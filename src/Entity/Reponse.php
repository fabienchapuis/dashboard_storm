<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ReponseRepository")
 */
class Reponse
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $placedispo;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\user",inversedBy="reponses")
     */
    private $evenement_id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement",inversedBy="presences")
     * @ORM\JoinColumn(nullable=false)
     */
    private $evenement;

    public function __construct()
    {
        $this->evenement_id = new ArrayCollection();
    }

    

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPlacedispo(): ?int
    {
        return $this->placedispo;
    }

    public function setPlacedispo(?int $placedispo): self
    {
        $this->placedispo = $placedispo;

        return $this;
    }

    public function getUserId(): ?int
    {
        return $this->user_id;
    }

    public function setUserId(int $user_id): self
    {
        $this->user_id = $user_id;

        return $this;
    }

    /**
     * @return Collection|user[]
     */
    public function getEvenementId(): Collection
    {
        return $this->evenement_id;
    }

    public function addEvenementId(user $evenementId): self
    {
        if (!$this->evenement_id->contains($evenementId)) {
            $this->evenement_id[] = $evenementId;
        }

        return $this;
    }

    public function removeEvenementId(user $evenementId): self
    {
        if ($this->evenement_id->contains($evenementId)) {
            $this->evenement_id->removeElement($evenementId);
        }

        return $this;
    }

    public function getEvenement(): ?Evenement
    {
        return $this->evenement;
    }

    public function setEvenement(?Evenement $evenement): self
    {
        $this->evenement = $evenement;

        return $this;
    }

    


}
