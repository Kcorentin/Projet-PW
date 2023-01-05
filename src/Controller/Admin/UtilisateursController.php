<?php

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


#[Route ('/admin/utilisateurs',name:'admin_utilisateurs_')]
class UtilisateursController extends AbstractController
{
    #[Route ('',name:'index')]
    public function index(): Response
    {
        return $this->render('admin/utilisateurs/index.html.twig');
    }

    #[Route ('/admin',name:'admin')]
    public function compteAdmin(): Response
    {
        return $this->render('admin/utilisateurs/admin.html.twig');
    }
}