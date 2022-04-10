<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use App\Entity\Curriculum;
use App\Form\CurriculumType;
use App\Repository\CurriculumRepository;
use App\Entity\Domaine;
use App\Form\DomaineType;
use App\Repository\DomaineRepository;
use App\Entity\File;
use App\Form\FileType;
use App\Repository\FileRepository;
use App\Entity\Image;
use App\Form\ImageType;
use App\Repository\ImageRepository;
use App\Entity\Pub;
use App\Form\PubType;
use App\Repository\PubRepository;
use App\Entity\TypeAnnonce;
use App\Form\TypeAnnonceType;
use App\Repository\TypeAnnonceRepository;
use App\Entity\TypeCompte;
use App\Form\TypeCompteType;
use App\Repository\TypeCompteRepository;
use App\Entity\TypeFile;
use App\Form\TypeFileType;
use App\Repository\TypeFileRepository;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Knp\Component\Pager\PaginatorInterface;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="app_accueil")
     */
    public function index(Request $request, PaginatorInterface $paginator, AnnonceRepository $annonceRepository): Response
    {
        $pagination = $paginator->paginate(
            $annonceRepository->findBy([], ["id" => "DESC"]), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            20/*limit per page*/
        );
        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'annonces' => $pagination,
        ]);
    }
}
