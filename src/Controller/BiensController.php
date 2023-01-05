<?php

namespace App\Controller;

use App\Entity\BiensImmobiliers;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/biens', name: 'biens_')]
class BiensController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('biens/index.html.twig');
    }

    #[Route('/{slug}', name: 'details')]
    public function details(BiensImmobiliers $biens): Response
    {
        return $this->render('biens/details.html.twig', compact('biens'));
    }

    
    public function randomBiens (BiensImmobiliers $biens): Response
    {
        
        return $this->render('main/index.html.twig', compact('biens'));
    }
}