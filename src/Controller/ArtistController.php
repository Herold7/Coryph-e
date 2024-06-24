<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/a')] // prefix all artist routes with /a
class ArtistController extends AbstractController
{
    #[Route('/', name: 'app_artist_index', methods: ['GET'])]
    public function index(
        ArtistRepository $artistRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $pagination = $paginator->paginate(
            $artistRepository->findAll(), // All artists
            $request->query->getInt('page', 1), // Check page number
            12 // Items per page
        );

        return $this->render('artist/index.html.twig', [
            'artists' => $pagination,
            'userArtists' => $artistRepository->findBy(
                ['user' => $this->getUser()]
            )
        ]);
    }

    #[Route('/category/{category}', name: 'app_artist_category', methods: ['GET'])]
    public function category(
        ArtistRepository $artistRepository,
        PaginatorInterface $paginator,
        Request $request,
        string $category
    ): Response {
        $pagination = $paginator->paginate(
            $artistRepository->findBy(['category' => $category]),
            $request->query->getInt('page', 1),
            12
        );

        return $this->render('artist/index.html.twig', [
            'artists' => $pagination,
            'userArtists' => $artistRepository->findBy(
                ['user' => $this->getUser()]
            )
        ]);
    }

    #[Route('/show/{id}', name: 'app_artist_show', methods: ['GET', 'POST'])]
    public function show(
        Artist $artist
    ): Response {
        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    #[Route('/new', name: 'app_artist_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $artist = new Artist();
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($artist);
            $entityManager->flush();

            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_artist_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Artist $artist, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
    
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }
    
        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_artist_delete', methods: ['POST'])]
    public function delete(Request $request, Artist $artist, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {
            $entityManager->remove($artist);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
    }
}
