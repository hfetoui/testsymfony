<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EquipementType;

use App\Entity\Equipement;

/**
 * @Route("/equipements", name="equipements")
 */
class EquipementController extends AbstractController
{
    /**
     * @Route("/", name="_liste")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
    	$equipements = $doctrine->getRepository(Equipement::class)->findAll();
 
        return $this->render('equipement/index.html.twig', [
            'equipements' => $equipements,
        ]);
    }

    /**
     * @Route("/new", name="_add")
     */
    public function add(Request $request,ManagerRegistry $doctrine): Response
    {
    	$equipement = new Equipement();

    	$form = $this->createForm(EquipementType::class, $equipement);
		$form->handleRequest($request);

    if ($request->isMethod('POST')) {

        if ($form->isSubmitted() && $form->isValid()) {

        	$entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($equipement);
            $entityManager->flush();

        	 return $this->redirectToRoute('equipements_liste');
        }
  }
                // if ($form->isSubmitted() ) die("form  submited");


        

            // if ($form->isValid()) die("form isValid");

        return $this->render('equipement/new.html.twig',
            array('form' => $form->createView())
        );
    }
}
