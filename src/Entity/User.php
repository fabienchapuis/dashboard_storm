<?php

namespace App\Entity;

use App\Entity\Reponse;
use App\Entity\Saison;
use Doctrine\Common\Collections\Collection;
use Serializable;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface,\Serializable
{

    const ROLE_USER = 'ROLE_USER';
	const ROLE_ADMIN = 'ROLE_ADMIN';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, unique=true)
     * @Assert\NotBlank()
     * @Assert\Length(min=5, max=50)
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**	
	* @Assert\NotBlank()
	* @Assert\Length(min=8, max=4096)
	*/
    private $plainPassword;
    

    /**
     * @ORM\Column(type="string", length=60, unique=true)
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telephone;
    

    /**
	* var array
	* @ORM\Column(type="simple_array")
	*/
	private $roles;



    /**
     * 
     * 
     * @ORM\ManyToMany(targetEntity="App\Entity\Saison", inversedBy="users")
     */
    private $saisons;


    public function __construct()
	{
		
		$this->followers = new ArrayCollection();

		$this->roles = [self::ROLE_USER];
		$this->enabled = false;
        $this->saisons =new ArrayCollection();
    }
    


	public function getRoles()
        {
            return $this->roles;
        }
	
	public function setRoles( array $roles )
    {
        $this->roles = $roles;
    
        }



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSalt()
	{
		return null;
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


	/**
	 * @return mixed
	 */
	public function getPlainPassword()
    {
        return $this->plainPassword;
        }

    /**
	 * @param mixed $plainPassword
	 */	
	public function setPlainPassword(string $plainPassword): void
    {
        $this->plainPassword = $plainPassword;
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
            $this->telephone
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
            $this->telephone

        ) = unserialize($serialized, ['allowed_classes' => false]);
    }



}
