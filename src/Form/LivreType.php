<?php

namespace App\Form;

use App\Entity\Genrelitteraire;
use App\Entity\Livre;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\UrlType;

class LivreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('auteur')
            ->add('description')
            ->add('genrelitteraire', EntityType::class, [
                    'placeholder' => 'Merci de choisir un genre littéraire',
                    'class' => Genrelitteraire::class,
            ])
            ->add('prix')
            ->add('image', UrlType::class, [
                'attr'=>[
                    'class'=>'#coupcoeur .tabs-content img'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Livre::class,
        ]);
    }
}
