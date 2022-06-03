<?php

namespace App\Controller;

use App\Entity\Livre;
use App\Entity\Pagesearch;
use App\Form\PagesearchType;
use App\Entity\Genrelitteraire;
use App\Repository\LivreRepository;
use App\Repository\PagesearchRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    #[Route('home/fantasy', name: 'app_page_fantasy')]
    public function index(LivreRepository $livreRepository): Response
    {
        return $this->render('page/fantasy.html.twig', [
            'controller_name' => 'PageController',
            'livrefantasys' => $livreRepository->findByLivreFantasy(),   
        ]);
    
    }

    #[Route('home/fantasy/{id}', name: 'app_page_fantasy_show', methods: ['GET'])]
    public function showfantasy(Livre $livre): Response
    {
        return $this->render('page/presentation/fantasy.html.twig', [
            'livrefantasys' => $livre,
        ]);
    }


    #[Route('home/fantastique', name: 'app_page_fantastique')]
    public function pagefantastique(LivreRepository $livreRepository): Response
    {
        return $this->render('page/fantastique.html.twig', [
            'controller_name' => 'PageController',
            'livrefantastiques' => $livreRepository->findByLivreFantastique()   
        ]);
    
    }

    #[Route('home/fantastique/{id}', name: 'app_page_fantastique_show', methods: ['GET'])]
    public function showfantastique(Livre $livre): Response
    {
        return $this->render('page/presentation/fantastique.html.twig', [
            'livrefantastiques' => $livre,
        ]);
    }

    #[Route('home/cinema', name: 'app_page_cinema')]
    public function pagecinema(LivreRepository $livreRepository): Response
    {
        return $this->render('page/cinema.html.twig', [
            'controller_name' => 'PageController',
            'livrecinemas' => $livreRepository->findByLivreCinema()   
        ]);
    
    }

    #[Route('home/cinema/{id}', name: 'app_page_cinema_show', methods: ['GET'])]
    public function showcinema(Livre $livre): Response
    {
        return $this->render('page/presentation/cinema.html.twig', [
            'livrecinemas' => $livre,
        ]);
    }

    #[Route('home/science-fiction', name: 'app_page_sf')]
    public function pagesf(LivreRepository $livreRepository): Response
    {
        return $this->render('page/science-fiction.html.twig', [
            'controller_name' => 'PageController',
            'livresfs' => $livreRepository->findByLivreSF()   
        ]);
    
    }

    #[Route('home/science-fiction/{id}', name: 'app_page_science-fiction_show', methods: ['GET'])]
    public function showsf(Livre $livre): Response
    {
        return $this->render('page/presentation/science-fiction.html.twig', [
            'livresfs' => $livre,
        ]);
    }

    #[Route('home/fantasy', name: 'app_fantasy_search')]
    public function recherche(Request $request, PagesearchRepository $pagesearchRepository): Response
    {
            $pagesearch = new Pagesearch();
            $form = $this->createForm(PagesearchType::class, $pagesearch);
            
            $form->handleRequest($request);
            if ($form->isSubmitted()) {
                $pagesearch = $pagesearchRepository->findBySearch($pagesearch);
            }
        
            return $this->render('search/search-form.html.twig', [
                'form' => $form->createView()
            ]);       
            
    }
}