<?php

namespace App\Controller;

use App\Entity\Pub;
use App\Form\PubType;
use App\Repository\PubRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

/**
 * @Route("/pub")
 */
class PubController extends AbstractController
{
    /**
     * @Route("/", name="app_pub_index", methods={"GET"})
     */
    public function index(PubRepository $pubRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $pagination = $paginator->paginate(
            $pubRepository->findBy([], ["id" => "DESC"]), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('pub/index.html.twig', [
            'pubs' => $pagination,
        ]);
    }

    /**
     * @Route("/new", name="app_pub_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PubRepository $pubRepository): Response
    {
        $pub = new Pub();
        $form = $this->createForm(PubType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubRepository->add($pub);
            return $this->redirectToRoute('app_pub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub/new.html.twig', [
            'pub' => $pub,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_show", methods={"GET"})
     */
    public function show(Pub $pub): Response
    {
        return $this->render('pub/show.html.twig', [
            'pub' => $pub,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pub_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Pub $pub, PubRepository $pubRepository): Response
    {
        $form = $this->createForm(PubType::class, $pub);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubRepository->add($pub);
            return $this->redirectToRoute('app_pub_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub/edit.html.twig', [
            'pub' => $pub,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_delete", methods={"POST"})
     */
    public function delete(Request $request, Pub $pub, PubRepository $pubRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pub->getId(), $request->request->get('_token'))) {
            $pubRepository->remove($pub);
        }

        return $this->redirectToRoute('app_pub_index', [], Response::HTTP_SEE_OTHER);
    }
}
