<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;


class UserFixtures extends Fixture
{
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
        $user = new User();
        $user->setUsername('niska');
        $user->setPassword($this->encoder->encodePassword($user,'niska'));
        $user->setEmail('fabien.ch@codeur.online');
        $user->SetTelephone('0654685945');
        $manager->persist($user);
        $manager->flush();

        $user = new User(); 
        $user->setRoles(array('ROLE_USER'));
        $user->setEnabled(true);
        $user->setUsername('revan');
        $user->setPassword($this->encoder->encodePassword($user,'revan'));
        $user->setEmail('fabien.ch@codeur.online');
        $user->SetTelephone('0686954682');
        $manager->persist($user);
        $manager->flush();



    }

    
}
