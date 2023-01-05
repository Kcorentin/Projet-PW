<?php

namespace App\Controller;

use App\Entity\Categories;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\CategoriesRepository;
use App\Repository\BiensImmobiliersRepository;

#[Route('/categories', name: 'categories_')]
class CategoriesController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(CategoriesRepository $categoriesRepository): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $categoriesRepository->findBy([], ['name' => 'ASC'])
        ]);
    }
    #[Route('/{slug}', name: 'list')]
    public function list(Categories $categorie): Response
    {

        //On va chercher la liste des produits de la catégorie
        $biens = $categorie->getBiensImmobiliers();

        return $this->render('categories/liste.html.twig', compact('categorie', 'biens'));
       
    }
}
