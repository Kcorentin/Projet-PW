<?php

namespace App\Controller\Admin;

use App\Entity\BiensImmobiliers;
use App\Form\BiensFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route ('/admin/biens',name:'admin_biens_')]
class BiensController extends AbstractController
{
    #[Route ('',name:'index')]
    public function index(): Response
    {
        return $this->render('admin/biens/index.html.twig');
    }
    #[Route ('/ajout',name:'ajout')]
    public function ajouter(Request $request,EntityManagerInterface $emi,SluggerInterface $slugger): Response
    {
        // on crée un nouveau bien
        $biens = new BiensImmobiliers ();

        // on crée le formulaire
        $biensForm = $this->createForm(BiensFormType::class, $biens);

        // on traite la requête du formulaire
        $biensForm ->handleRequest($request);
        
        // on vérifie si le formulaire est soumis et valide
        if ($biensForm->isSubmitted() && $biensForm->isValid()) { 
            // on génère le slug
            $slug = $slugger -> slug($biens->getTitre());
            $biens->setSlug($slug);

               // On stocke
               $emi->persist($biens);
               $emi->flush();

               $this->addFlash('success', 'Bien ajouté avec succès');

               return $this->redirectToRoute('admin_biens_index');
        }

        return $this->render('admin/biens/ajout.html.twig',compact('biensForm'));
    }
    #[Route ('/modifier/{id}',name:'modifier')]
    public function modifier(Biens $biens): Response
    {
        return $this->render('admin/biens/index.html.twig');
    }
    #[Route ('/supprimer/{id}',name:'supprimer')]
    public function supprimer(Biens $biens): Response
    {
        return $this->render('admin/biens/index.html.twig');
    }
}