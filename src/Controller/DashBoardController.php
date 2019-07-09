<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashBoardController extends AbstractController
{
    /**
     * @Security("is_granted('ROLE_ADMIN')")
     * @Route("/dash", name="dash")
     */
    public function index()
    {
        return $this->render('dash_board/index.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }
}
