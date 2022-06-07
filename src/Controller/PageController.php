<?php

namespace App\Controller;

use App\Data\Search;
use App\Entity\Livre;
use App\Entity\Pagesearch;
use App\Form\PagesearchType;
use App\Entity\Genrelitteraire;
use App\Form\SearchForm;
use App\Repository\LivreRepository;
use App\Repository\PagesearchRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager){
        $this->entityManager = $entityManager;
    }

    #[Route('home/nouveaute', name: 'app_page_nouveaute')]
    public function index(LivreRepository $repository, Request $request): Response
    {
        $data = new Search();
        $data->page = $request->get('page', 1);
        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);

        $livres = $repository->findSearch($data);
        return $this->render('page/nouveaute.html.twig', [
            'controller_name' => 'PageController',
            'livrenouveautes' => $livres,
            'form' => $form->createView()
        ]);

    }

    #[Route('home/nouveaute/{id}', name: 'app_page_nouveaute_show', methods: ['GET'])]
    public function shownouveaute(Livre $livre): Response
    {
        return $this->render('page/presentation/nouveaute.html.twig', [
            'livrenouveautes' => $livre,
        ]);
    }
}
