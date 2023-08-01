<?php

namespace App\Controller;

use App\Entity\CV;
use App\Form\CVType;
use App\Repository\CVRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/cv')]
class CVController extends AbstractController
{
    #[Route('/', name: 'app_c_v_index', methods: ['GET'])]
    public function index(CVRepository $cVRepository): Response
    {
        return $this->render('cv/index.html.twig', [
            'c_vs' => $cVRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_c_v_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $cV = new CV();
        $form = $this->createForm(CVType::class, $cV);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($cV);
            $entityManager->flush();

            return $this->redirectToRoute('app_c_v_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cv/new.html.twig', [
            'c_v' => $cV,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_v_show', methods: ['GET'])]
    public function show(CV $cV): Response
    {
        return $this->render('cv/show.html.twig', [
            'c_v' => $cV,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_c_v_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, CV $cV, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(CVType::class, $cV);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_c_v_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('cv/edit.html.twig', [
            'c_v' => $cV,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_c_v_delete', methods: ['POST'])]
    public function delete(Request $request, CV $cV, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$cV->getId(), $request->request->get('_token'))) {
            $entityManager->remove($cV);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_c_v_index', [], Response::HTTP_SEE_OTHER);
    }
}