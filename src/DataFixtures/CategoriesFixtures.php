<?php

namespace App\DataFixtures;

use App\Entity\Categories;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;

class CategoriesFixtures extends Fixture
{   
    private $counter = 1;

    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        $categories = [
            1 => [
                'name' => 'Terrain Agricole',
                
            ],
            2 => [
                'name' => 'Prairie',
                
            ],
            3 => [
                'name' => 'Bois',
              
            ],
            4 => [
                'name' => 'Bâtiments',
                
            ],
            5=> [
                'name' => 'Exploitations',
            ]
        ];
        foreach($categories as $key => $value){
            $categorie = new Categories();
            $categorie->setName($value['name']);
            $categorie->setSlug($this->slugger->slug($categorie->getName())->lower());
            $manager->persist($categorie);

            $this->addReference('categorie_' . $key, $categorie);
        }

        $manager->flush();
    }

    
}
