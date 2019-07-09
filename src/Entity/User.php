<?php
//!!point de retour fonctionnnel

namespace App\Entity;

use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;


/**
 * 
 * 
 * @ORM\Table(name="app_users")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity(fields="username", message="Cet identifiant est déjà enregistré en base")
 * 
 */
class User implements UserInterface,\Serializable
{
    /**
     * @ORM\Id()
     *@ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=25,)
     * @Assert\NotBlank()
     * @Assert\Length(max=25)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=64)
     */
    private $password;

    /**
     * 
     * @ORM\Column(type="string", length=60 )
     * @Assert\NotBlank()
     * @Assert\Length(max=60)
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=12)
     */
    private $telephone;


    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;


      
    public function __construct()
    {
        $this->isActive = true;
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }
    public function getIsActive()
    {
        return $this->isActive;
    }
 
    /*
     * Set isActive
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;
        return $this;
    }




    /**
     * @return(ROLE|string)[] The user Role
     * 
     * 
     */

    public function getRoles()
    {
        return['ROLE_ADMIN'];
    }



    /**
     * 
     * @return string|null
     */

    public function getSalt()
    {
        
    }

    public function eraseCredentials()
    {
        
    }

    /**
     * @return string
     * @since 5.1.0
     */
    
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->telephone,
            $this->isActive
        ]);
    }


    /**
     * 
     * @param string $serialized <p>
     * the string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */

    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
            $this->email,
            $this->telephone,
            $this->isActive

        ) = unserialize($serialized, ['allowed_classes' => false]);
    }


}
