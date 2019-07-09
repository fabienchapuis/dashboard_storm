<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManager;

class SecurityController extends AbstractController
{
    /**
     * @Route("/", name="security_login")
     */
    
    public function login(AuthenticationUtils $authenticationUtils)
    {
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('security/index.html.twig',[
            'last_username' => $lastUsername,
            'error' => $error
        ]);
    }


    /**
     * @Route("/confirm/{token}", name="security_confirm")
     * 
     */
    public function confirm(string $token, UserRepository $userRepository, EntityManager $entityManager){

        $user = $userRepository->findOneBy([
            'confirmationToken' => $token
        ]);
        

        if( null !==$user){
            $user->setEnabled(true);
            $user->setConfirmToken('');

            $entityManager->flush();
        }

        return new Response($this->twig->render('dashboard/index.html.twig',[
            'user' => $user
        ]));

    }

}
