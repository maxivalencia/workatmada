<?php

namespace App\Controller;

use App\Entity\PubHor;
use App\Form\PubHorType;
use App\Repository\PubHorRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/pubhor/hor")
 */
class PubHorController extends AbstractController
{
    /**
     * @Route("/", name="app_pub_hor_index", methods={"GET"})
     */
    public function index(PubHorRepository $pubHorRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $pubHorRepository->findBy([], ["id" => "DESC"]), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('pub_hor/index.html.twig', [
            'pub_hors' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="app_pub_hor_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PubHorRepository $pubHorRepository): Response
    {
        $pubHor = new PubHor();
        $form = $this->createForm(PubHorType::class, $pubHor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubHorRepository->add($pubHor);
            return $this->redirectToRoute('app_pub_hor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub_hor/new.html.twig', [
            'pub_hor' => $pubHor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_hor_show", methods={"GET"})
     */
    public function show(PubHor $pubHor): Response
    {
        return $this->render('pub_hor/show.html.twig', [
            'pub_hor' => $pubHor,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pub_hor_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PubHor $pubHor, PubHorRepository $pubHorRepository): Response
    {
        $form = $this->createForm(PubHorType::class, $pubHor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubHorRepository->add($pubHor);
            return $this->redirectToRoute('app_pub_hor_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub_hor/edit.html.twig', [
            'pub_hor' => $pubHor,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_hor_delete", methods={"POST"})
     */
    public function delete(Request $request, PubHor $pubHor, PubHorRepository $pubHorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pubHor->getId(), $request->request->get('_token'))) {
            $pubHorRepository->remove($pubHor);
        }

        return $this->redirectToRoute('app_pub_hor_index', [], Response::HTTP_SEE_OTHER);
    }
}
