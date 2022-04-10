<?php

namespace App\Controller;

use App\Entity\PubVer;
use App\Form\PubVerType;
use App\Repository\PubVerRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/pub/ver")
 */
class PubVerController extends AbstractController
{
    /**
     * @Route("/", name="app_pub_ver_index", methods={"GET"})
     */
    public function index(PubVerRepository $pubVerRepository): Response
    {
        return $this->render('pub_ver/index.html.twig', [
            'pub_vers' => $pubVerRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_pub_ver_new", methods={"GET", "POST"})
     */
    public function new(Request $request, PubVerRepository $pubVerRepository): Response
    {
        $pubVer = new PubVer();
        $form = $this->createForm(PubVerType::class, $pubVer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubVerRepository->add($pubVer);
            return $this->redirectToRoute('app_pub_ver_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub_ver/new.html.twig', [
            'pub_ver' => $pubVer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_ver_show", methods={"GET"})
     */
    public function show(PubVer $pubVer): Response
    {
        return $this->render('pub_ver/show.html.twig', [
            'pub_ver' => $pubVer,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="app_pub_ver_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, PubVer $pubVer, PubVerRepository $pubVerRepository): Response
    {
        $form = $this->createForm(PubVerType::class, $pubVer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $pubVerRepository->add($pubVer);
            return $this->redirectToRoute('app_pub_ver_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('pub_ver/edit.html.twig', [
            'pub_ver' => $pubVer,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="app_pub_ver_delete", methods={"POST"})
     */
    public function delete(Request $request, PubVer $pubVer, PubVerRepository $pubVerRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$pubVer->getId(), $request->request->get('_token'))) {
            $pubVerRepository->remove($pubVer);
        }

        return $this->redirectToRoute('app_pub_ver_index', [], Response::HTTP_SEE_OTHER);
    }
}
