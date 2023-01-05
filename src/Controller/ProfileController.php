<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/profil', name: 'profil_')]
class ProfileController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Profil de l\'utilisateurs',
        ]);
    }
    #[Route('/favoris', name: 'favoris')]
    public function favoris(): Response
    {
        return $this->render('profile/index.html.twig', [
            'controller_name' => 'Favoris de l\'utilisateurs',
        ]);
    }
   
}
