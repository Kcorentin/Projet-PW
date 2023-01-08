<?php

namespace App\Controller;


use App\Controller\EntityManager;
use App\Entity\BiensImmobiliers;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\BiensImmobiliersRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class MainController extends AbstractController
{
    #[Route('/', name: 'main')]
    public function index(ManagerRegistry $doctrine): Response
    {
     


        $biensRepository = $doctrine->getRepository(BiensImmobiliers::class);
        $query = $biensRepository->createQueryBuilder('b')
        ->getQuery();
        $randombien = $query->getResult();
            
    
       
        $random1= rand(0,count($randombien)-1);
        $random2= rand(0,count($randombien)-1);
        $random3= rand(0,count($randombien)-1);
        


        return $this->render('main/index.html.twig',[
           'biens'=>$randombien, 'r1'=>$random1,
           'r2'=>$random2,'r3'=>$random3,
        ]);
    }
 
}
