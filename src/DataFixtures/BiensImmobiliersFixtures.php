<?php

namespace App\DataFixtures;

use App\Entity\BiensImmobiliers;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\String\Slugger\SluggerInterface;
use Faker;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;



class BiensImmobiliersFixtures extends Fixture implements DependentFixtureInterface
{
    public function __construct(private SluggerInterface $slugger){}

    public function load(ObjectManager $manager): void
    {
        // use the factory to create a Faker\Generator instance
        $faker = Faker\Factory::create('fr_FR');

        for($i = 1; $i <= 10; $i++){
            $biens = new BiensImmobiliers();
            $biens->setTitre($faker->text(50));
            $biens->setSurface($faker->numberBetween(1,100));
            $biens->setDescription($faker->text());
            $biens->setVille($faker->text());
            $biens->setCodepostal(str_replace(' ', '', $faker->postcode));

            $biens->setSlug($this->slugger->slug($biens->getTitre())->lower());
            $biens->setPrix($faker->numberBetween(900, 1500000));
            $biens->setVentesOuLocations($faker->randomElement(['vente', 'location']));

            //On va chercher une référence de catégorie
            $categorie = $this->getReference('categorie_'. rand(1, 5));
            $biens->setType($categorie);
            $this->setReference('biens-'.$i,$biens);
          

            $manager->persist($biens);
        }

        $manager->flush();
    }
    public function getDependencies()
    {
        return [
            CategoriesFixtures::class,
            
        ];
    }
}