<?php

namespace App\Controller;

use App\Entity\Shops;
use App\Form\ShopsType;
use App\Repository\ShopsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/shops')]
class ShopsController extends AbstractController
{
    #[Route('/', name: 'app_shops_index', methods: ['GET'])]
    public function index(ShopsRepository $shopsRepository): Response
    {
        return $this->render('shops/index.html.twig', [
            'shops' => $shopsRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_shops_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ShopsRepository $shopsRepository): Response
    {
        $shop = new Shops();
        $form = $this->createForm(ShopsType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shopsRepository->save($shop, true);

            return $this->redirectToRoute('app_shops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('shops/new.html.twig', [
            'shop' => $shop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shops_show', methods: ['GET'])]
    public function show(Shops $shop): Response
    {
        return $this->render('shops/show.html.twig', [
            'shop' => $shop,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_shops_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Shops $shop, ShopsRepository $shopsRepository): Response
    {
        $form = $this->createForm(ShopsType::class, $shop);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $shopsRepository->save($shop, true);

            return $this->redirectToRoute('app_shops_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('shops/edit.html.twig', [
            'shop' => $shop,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_shops_delete', methods: ['POST'])]
    public function delete(Request $request, Shops $shop, ShopsRepository $shopsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$shop->getId(), $request->request->get('_token'))) {
            $shopsRepository->remove($shop, true);
        }

        return $this->redirectToRoute('app_shops_index', [], Response::HTTP_SEE_OTHER);
    }
}
