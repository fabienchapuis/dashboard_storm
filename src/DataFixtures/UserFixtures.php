<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Common\Collections\ArrayCollection;


class UserFixtures extends Fixture
{

    private const USERS = [
        [
            'username' => 'niska',
            'telephone' =>'0625412548',
            'email' => 'fabien.ch@codeur.online',
            'password' => 'niska',
            'roles' => [User::ROLE_USER]
        ],
        
        [
            'username' => 'super_admin',
            'telephone' =>'0625412548',
            'email' => 'admin@admin.fr',
            'password' => 'admin',
            'roles' => [User::ROLE_ADMIN]
        ]
    ];
    



    /**
     * 
     * @var UserPasswordEncoderInterface
     */
    private $encoder;






    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }


    public function load(ObjectManager $manager)
    {
        $this->loadUsers( $manager );
        
        
    }

    private function loadUsers( ObjectManager $manager )
    {
        
        foreach( self::USERS as $userData ){
            $user = new User();
            $user->setUsername($userData['username']);
            $user->setEmail($userData['email']);
            $user->setTelephone($userData['telephone']);
            $user->setPassword($this->encoder->encodePassword($user, $userData['password']));
            $user->setRoles($userData['roles']);
            
            $manager->persist( $user );
        }
        $manager->flush();
    }
}
