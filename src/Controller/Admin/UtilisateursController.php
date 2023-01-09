<?php

namespace App\Controller\Admin;



use App\Controller\EntityManager;
use App\Form\UsersFormType;
use App\Entity\Utilisateurs;
use Doctrine\Persistence\ManagerRegistry;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;


#[Route ('/admin/utilisateurs',name:'admin_utilisateurs_')]
class UtilisateursController extends AbstractController
{
    #[Route ('',name:'index')]
    public function index(ManagerRegistry $doctrine): Response
    {

        $userRepository = $doctrine->getRepository(Utilisateurs::class);
        $query = $userRepository->createQueryBuilder('b')
        ->getQuery();
        $users = $query->getResult();
            
        return $this->render('admin/utilisateurs/index.html.twig',compact('users'));
    }

    #[Route ('/ajout',name:'ajout')]
    public function ajouter(Request $request,EntityManagerInterface $emi): Response
    {
       
        $users = new Utilisateurs ();

        // on crée le formulaire
        $usersForm = $this->createForm(UsersFormType::class, $users);

        // on traite la requête du formulaire
        $usersForm ->handleRequest($request);
        
        // on vérifie si le formulaire est soumis et valide
        if ($usersForm->isSubmitted() && $usersForm->isValid()) { 
            

               // On stocke
               $emi->persist($users);
               $emi->flush();

               $this->addFlash('success', 'Bien ajouté avec succès');

               return $this->redirectToRoute('admin_utilisateurs_index');
        }

        return $this->render('admin/utilisateurs/ajout.html.twig',compact('usersForm'));
    }

    #[Route ('/modifier/{id}',name:'modifier')]
    public function modifier(Utilisateurs $users,Request $request,EntityManagerInterface $emi): Response
    { 
        // on crée le formulaire
        $usersForm = $this->createForm(UsersFormType::class, $users);

        // on traite la requête du formulaire
        $usersForm ->handleRequest($request);
        
        // on vérifie si le formulaire est soumis et valide
        if ($usersForm->isSubmitted() && $usersForm->isValid()) { 
            
         
               $emi->persist($users);
               $emi->flush();

               $this->addFlash('success', 'Bien ajouté avec succès');

               return $this->redirectToRoute('admin_utilisateurs_index');
        }

        return $this->render('admin/utilisateurs/modifier.html.twig',compact('usersForm'));
    }


    #[Route ('/supprimer/{id}',name:'supprimer')]
    public function supprimer(Utilisateurs $users,Request $request,EntityManagerInterface $emi): Response
    {   
        
        // on crée le formulaire
        $usersForm = $this->createForm(UsersFormType::class, $users);

        // on traite la requête du formulaire
        $usersForm ->handleRequest($request);
        
        // on vérifie si le formulaire est soumis et valide
        if ($usersForm->isSubmitted() && $usersForm->isValid()) { 
            // on génère le slug
          

               // On stocke
               $emi->remove($users);
               $emi->flush();

               $this->addFlash('success', 'utilisateur supprimé');

               return $this->redirectToRoute('admin_utilisateurs_index');
        }

        return $this->render('admin/utilisateurs/supprimer.html.twig',compact('usersForm'));
    }
}