<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Repository\LivreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PageController extends AbstractController
{
    #[Route('home/page', name: 'app_page')]
    public function index(LivreRepository $livreRepository): Response
    {

        #$tabs = [1];
        #$livreRepository = $this->getDoctrine();
            #->getRepository(Livre::class)
            #->findMyGenre($tabs);

        return $this->render('page/page.html.twig', [
            'controller_name' => 'PageController',
            'livrepublics' => $livreRepository->findByExampleField()
        ]);
    
    }

    #public function searchBar()
    #{
        #$form = $this->createFormBuilder()
            #->setAction($this->generateUrl('handleSearch'))
            #->add('query', TextType::class, [
                #'label' => false,
                #'attr' => [
                    #'class' => 'form-control',
                    #'placeholder' => 'Entrez un mot-clé'
                #]
            #])
            #->add('recherche', SubmitType::class, [
                #'attr' => [
                    #'class' => 'btn btn-primary'
                #]
            #])
            #->getForm();
        #return $this->render('search/searchBar.html.twig', [
            #'form' => $form->createView()
        #]);
    #}

    
    //#[Route('home/handleSearch', name: 'handleSearch')]

    #public function handleSearch(Request $request, ArticleRepository $repo)
    #{
        #$query = $request->request->all('form')['query'];
        #if($query) {
            #$auteurs = $repo->findLivreByAuteur($query);
        #}
        #return $this->render('search/index.html.twig', [
            #'auteurs' => $auteurs
        #]);
    #}


}
