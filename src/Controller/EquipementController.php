<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;
use App\Form\EquipementType;

use App\Entity\Equipement;

/**
 * @Route("/equipements", name="equipement controller")
 */
class EquipementController extends AbstractController
{
    /**
     * @Route("/", name="equipements_liste")
     */
    public function index(ManagerRegistry $doctrine): Response
    {
    	$equipements = $doctrine->getRepository(Equipement::class)->findAll();
 
        return $this->render('equipement/index.html.twig', [
            'equipements' => $equipements,
        ]);
    }

    
}
