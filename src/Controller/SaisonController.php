<?php

namespace App\Controller;


use session;
use App\Entity\Saison;
use App\Form\SaisonType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class SaisonController extends AbstractController
{

    public function __construct( RouterInterface $router )
    {
        $this->router = $router;

    }


    /**
     * @var RouterInterface
     */

    private $router;


    /**
     * @Route("/admin/new", name="new")
     * 
     * 
     */
    public function index()
    {
        
        return $this->render('dashboard/saison.html.twig');

    }

    /**
     * 
     * @Route("/admin/create", name="create")
     */
    public function create( Request $request)
    {
        $saison = new Saison();
        $form = $this->createForm(SaisonType::class,$saison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($saison);
            $entityManager->flush(); 
            return new RedirectResponse( $this->router->generate('create'));

        }


        return $this->render('dashboard/saison.html.twig', [
            'saisonForm' => $form->createView()

            
        ]);
    }

}

