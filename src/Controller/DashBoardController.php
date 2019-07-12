<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashBoardController extends AbstractController
{
    /**
     * 
     * @Route("/admin/dash", name="dash")
     */
    public function index()
    {
        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashBoardController',
        ]);
    }

    
}
