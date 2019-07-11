<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SaisonRepository")
 */
class Saison
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nom;

    /**
     * @ORM\Column(type="integer")
     */
    private $user_id;


    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Evenement",inversedBy="saisons" )
     * 
     * 
     */
    private $evenements;



    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\User", inversedBy="saisons" )
     * 
     * 
     */
    private $users;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

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
}
