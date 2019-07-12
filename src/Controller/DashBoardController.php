<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\DashBoardController;

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

    /**
     * 
     * 
     */

}
