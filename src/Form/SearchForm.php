<?php

namespace App\Form;

use App\Data\Search;
use App\Entity\Genrelitteraire;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('recherche', TextType::class,[
                'label' => false,
                'required'=> false,
                'attr' => [
                    'placeholder' => 'Rechercher par titre ...',
                    'class' => 'search-input'
                ]
            ])
            ->add('genrelitteraire', EntityType::class,[
                'label' => false,
                'required' => false,
                'class' => Genrelitteraire::class,
                'expanded' => true,
                'multiple' => true,
                'attr' => [
                    'class' => 'form-check'
                ]
            ])
        ;
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Search::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }

}
