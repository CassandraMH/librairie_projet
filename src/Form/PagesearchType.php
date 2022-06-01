<?php

namespace App\Form;

use App\Entity\Pagesearch;
use App\Entity\Livre;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PagesearchType extends AbstractType
{

    public $routeGenerator;

    public function __construct(UrlGeneratorInterface $routeGenerator)
    {
        $this->routeGenerator = $routeGenerator;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('auteur', TextType::class, [
                'required' => true,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Recherche par auteur'
                ]
                
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Pagesearch::class,
            'method' => 'get', // lors de la soumission du formulaire, les paramètres transiteront dans l'url. Utile pour partager la recherche par exemple
            'csrf_protection' => false,
            'action' => $this->routeGenerator->generate('app_fantasy_search'), // on définit l'action qui doit traiter le formulaire. Si cette option n'est pas renseignée, le formulaire sera traité par la page en cours, ce qui n'est pas ce que l'on souhaite (tu peux essayer d'enlever cette option et envoyer le formulaire pour voir)

        ]);
    }

    public function getBlockPrefix()
    {
        // permet d'enlever les préfixe dans l'url. Tu peux commenter cette fonction, soumettre le formulaire et regarder l'url pour voir la différence.
        return '';
    }

}
