<?php

namespace App\Controller;

use App\Entity\TypeAnnonce;
use App\Form\TypeAnnonceType;
use App\Repository\TypeAnnonceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/type/annonce")
 */
class TypeAnnonceController extends AbstractController
{
    /**
     * @Route("/", name="app_type_annonce_index", methods={"GET"})
     */
    public function index(TypeAnnonceRepository $typeAnnonceRepository): Response
    {
        return $this->render('type_annonce/index.html.twig', [
            'type_annonces' => $typeAnnonceRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_type_annonce_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypeAnnonceRepository $typeAnnonceRepository): Response
    {
        $typeAnnonce = new TypeAnnonce();
        $form = $this->createForm(TypeAnnonceType::class, $typeAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeAnnonceRepository->add($typeAnnonce);
            return $this->redirectToRoute('app_type_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_annonce/new.html.twig', [
            'type_annonce' => $typeAnnonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_annonce_show", methods={"GET"})
     */
    public function show(TypeAnnonce $typeAnnonce): Response
    {
        return $this->render('type_annonce/show.html.twig', [
            'type_annonce' => $typeAnnonce,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_type_annonce_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeAnnonce $typeAnnonce, TypeAnnonceRepository $typeAnnonceRepository): Response
    {
        $form = $this->createForm(TypeAnnonceType::class, $typeAnnonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeAnnonceRepository->add($typeAnnonce);
            return $this->redirectToRoute('app_type_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_annonce/edit.html.twig', [
            'type_annonce' => $typeAnnonce,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_annonce_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeAnnonce $typeAnnonce, TypeAnnonceRepository $typeAnnonceRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeAnnonce->getId(), $request->request->get('_token'))) {
            $typeAnnonceRepository->remove($typeAnnonce);
        }

        return $this->redirectToRoute('app_type_annonce_index', [], Response::HTTP_SEE_OTHER);
    }
}
