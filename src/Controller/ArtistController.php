<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Repository\ArtistRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/a')] // prefix all artist routes with /a
class artistController extends AbstractController
{
    #[Route('/', name: 'app_artist', methods: ['GET'])]
    public function index(
        ArtistRepository $ArtistRepository,
        PaginatorInterface $paginator,
        Request $request,
    ): Response {
        $pagination = $paginator->paginate(
            $ArtistRepository->findAll(), // All artists
            $request->query->getInt('page', 1), // Check page number
            12 // Items per page
        );

        return $this->render('artist/index.html.twig', [
            'artists' => $pagination,
            'userArtists' => $ArtistRepository->findBy(
                ['host' => $this->getUser()]
            )
        ]);
    }

    #[Route('/{category}', name: 'app_artist_category', methods: ['GET'])]
    public function category(
        ArtistRepository $ArtistRepository,
        PaginatorInterface $paginator,
        Request $request,
    ): Response {
        $pagination = $paginator->paginate(
            $ArtistRepository->findBy(['category' => $request->attributes->get('category')]),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('artist/index.html.twig', [
            'artists' => $pagination,
            'userArtists' => $ArtistRepository->findBy(
                ['host' => $this->getUser()]
            )
        ]);
    }

    #[Route('/details/{id}', name: 'artist', methods: ['GET', 'POST'])]
    public function details(
        Artist $artist,
    ): Response {
        return $this->render('artist/details.html.twig', [
            'artist' => $artist,
        ]);
    }

}
