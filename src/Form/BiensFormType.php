<?php

namespace App\Form;

use App\Entity\BiensImmobiliers;
use App\Entity\Categories;
use App\Repository\CategoriesRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BiensFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('surface')
            ->add('prix')
            ->add('ville')
            ->add('codepostal')
            ->add('description')
            ->add('VentesOuLocations')
            ->add('type',EntityType::class,[
                'class'=> Categories::class,
                'choice_label' => 'name',
                'label' => 'Catégorie',
                'query_builder' => function(CategoriesRepository $cr){
                    return $cr->createQueryBuilder('c')
                        ->orderBy('c.name', 'ASC');
                }
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => BiensImmobiliers::class,
        ]);
    }
}
