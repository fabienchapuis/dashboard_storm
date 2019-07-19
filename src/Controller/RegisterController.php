<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class RegisterController extends AbstractController
{

    /**
     * @var UserRepository
     */
    private $userRepository;



    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }



    /**
     * @Route("/admin/register", name="admin_register")
     * 
     */
    public function index(UserRepository $userRepository)
    {
        $users = $this->userRepository ->findAll();
        return $this->render('register/list.html.twig',
        ['users'=>$users]);

    }










}