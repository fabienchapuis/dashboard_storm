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
use App\Repository\SaisonRepository;

class SaisonController extends AbstractController
{

    


     /**
     * @var SaisonRepository
     */

    private $saisonRepository;


    /**
     * @var RouterInterface
     */

    private $router;



    public function __construct( RouterInterface $router ,SaisonRepository $saisonRepository )
    {
        $this->router = $router;
        $this->saisonRepository = $saisonRepository;

    }



    /**
     * @Route("/admin/saison", name="saison_list")
     * 
     * 
     */
    public function index()
    {
        
        $saisons = $this->saisonRepository ->findAll();
        return $this->render('dashboard/saison/list.html.twig',
    ['saisons' => $saisons]);

    }

    /**
     * 
     * @Route("/admin/saison/new", name="saison_add")
     */
    public function create(Request $request)
    {
        $saison = new Saison();
        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($saison);
            $entityManager->flush(); 
            return new RedirectResponse( $this->router->generate('saison_list'));

        }


        return $this->render('dashboard/saison/saison.html.twig', [
            'saisonForm' => $form->createView()

            
        ]);
    }


    /**
     * @Route("admin/saison/{id}", name="saison_edit", methods="GET|POST")
     * 
     */
    public function edit (Request $request, Saison $saison)
    {
        
        $form = $this->createForm(SaisonType::class, $saison);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $this->getDoctrine()->getManager()->flush();
            

        }
        return new RedirectResponse( $this->router->generate('saison_add'));

    }





    /**
     * @Route("/admin/saison/{id}", name="saison_delete", methods="DELETE")
     */
    public function delete(Request $request, Saison $saison)
    {
        if ($this->isCsrfTokenValid('delete'.$saison->getId(), $request->request->get('_token'))){
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($saison);
            $entityManager->flush();
            $this->addFlash('success', 'supprimer avec succés !!!!');
        }
        return new RedirectResponse( $this->router->generate('saison_list'));
    }



}

