<?php

namespace App\Controller\Admin;

use App\Controller\Admin\Biens;

use App\Controller\EntityManager;
use App\Entity\BiensImmobiliers;
use Doctrine\Persistence\ManagerRegistry;
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
    public function index(ManagerRegistry $doctrine): Response
    {

        $biensRepository = $doctrine->getRepository(BiensImmobiliers::class);
        $query = $biensRepository->createQueryBuilder('b')
        ->getQuery();
        $biens = $query->getResult();
            
        return $this->render('admin/biens/index.html.twig',compact('biens'));
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
    public function modifier(BiensImmobiliers $biens,Request $request,EntityManagerInterface $emi,SluggerInterface $slugger): Response
    { 
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

        return $this->render('admin/biens/modifier.html.twig',compact('biensForm'));
    }


    #[Route ('/supprimer/{id}',name:'supprimer')]
    public function supprimer(BiensImmobiliers $biens,Request $request,EntityManagerInterface $emi,SluggerInterface $slugger): Response
    {   
        
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
               $emi->remove($biens);
               $emi->flush();

               $this->addFlash('success', 'Bien supprimé');

               return $this->redirectToRoute('admin_biens_index');
        }

        return $this->render('admin/biens/supprimer.html.twig',compact('biensForm'));
    }
}