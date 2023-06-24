<?php

namespace App\Controller;
use App\Repository\ProductRepository;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
     public function x(ProductRepository $productRepository): Response
    {
        return $this->render('home/index.html.twig', [
            'products' => $productRepository->findAll(),
        ]);
    }

    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
    
}
