<?php

namespace App\Controller;

use App\Entity\TypeCompte;
use App\Form\TypeCompteType;
use App\Repository\TypeCompteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/type/compte")
 */
class TypeCompteController extends AbstractController
{
    /**
     * @Route("/", name="app_type_compte_index", methods={"GET"})
     */
    public function index(TypeCompteRepository $typeCompteRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $typeCompteRepository->findBy([], ["id" => "DESC"]), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('type_compte/index.html.twig', [
            'type_comptes' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="app_type_compte_new", methods={"GET", "POST"})
     */
    public function new(Request $request, TypeCompteRepository $typeCompteRepository): Response
    {
        $typeCompte = new TypeCompte();
        $form = $this->createForm(TypeCompteType::class, $typeCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeCompteRepository->add($typeCompte);
            return $this->redirectToRoute('app_type_compte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_compte/new.html.twig', [
            'type_compte' => $typeCompte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_compte_show", methods={"GET"})
     */
    public function show(TypeCompte $typeCompte): Response
    {
        return $this->render('type_compte/show.html.twig', [
            'type_compte' => $typeCompte,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_type_compte_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, TypeCompte $typeCompte, TypeCompteRepository $typeCompteRepository): Response
    {
        $form = $this->createForm(TypeCompteType::class, $typeCompte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $typeCompteRepository->add($typeCompte);
            return $this->redirectToRoute('app_type_compte_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('type_compte/edit.html.twig', [
            'type_compte' => $typeCompte,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_type_compte_delete", methods={"POST"})
     */
    public function delete(Request $request, TypeCompte $typeCompte, TypeCompteRepository $typeCompteRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$typeCompte->getId(), $request->request->get('_token'))) {
            $typeCompteRepository->remove($typeCompte);
        }

        return $this->redirectToRoute('app_type_compte_index', [], Response::HTTP_SEE_OTHER);
    }
}
