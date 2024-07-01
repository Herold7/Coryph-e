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

#[Route('/a')] // prefixe toutes les routes par /a
class ArtistController extends AbstractController
{
    #[Route('/', name: 'app_artist_index', methods: ['GET'])]// Route pour afficher la liste des artistes
    public function index(
        ArtistRepository $artistRepository,
        PaginatorInterface $paginator,
        Request $request
    ): Response {
        $pagination = $paginator->paginate(
            $artistRepository->findAll(), // Tous les artistes
            $request->query->getInt('page', 1), // Page actuelle
            12 // Items per page
        );

        return $this->render('artist/index.html.twig', [
            'artists' => $pagination,
            'musicianArtists' => $artistRepository->findBy(
                ['musician' => $this->getUser()]
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
            'musicianArtists' => $artistRepository->findBy(
                ['musician' => $this->getUser()]
            )
        ]);
    }

    #[Route('/show/{id}', name: 'app_artist_show', methods: ['GET', 'POST'])]// Route pour afficher un artiste
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

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        $artist = new Artist();
        $artist->setMusician($this->getUser()); // Définir le musicien sur l'utilisateur actuellement connecté
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {// Vérifiez si le formulaire a été soumis et est valide
            $entityManager->persist($artist);
            $entityManager->flush();

            $this->addFlash('success', 'La fiche artiste a été créée avec succès.');
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/edit/{id}', name: 'app_artist_edit', methods: ['GET', 'POST'])]// Route pour modifier un artiste
    public function edit(Request $request, Artist $artist, EntityManagerInterface $entityManager): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        try {
            // Vérifiez si le musicien est autorisé à modifier l'artiste
            if ($artist->getMusician() !== $this->getUser()) {
                throw $this->createAccessDeniedException('Vous n\'étes pas autorisé à modifier cette fiche artiste.');
            }
        } catch (\Exception $e) {// Récupère l'erreur
            
            $this->addFlash('error', 'Une erreur s\'est produite lors de la modification de la fiche artiste.');
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            $this->addFlash('success', 'La fiche artiste a été modifié avec succès.');
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_artist_delete', methods: ['GET','POST'])]// Route pour supprimer un artiste
    public function delete(Request $request, Artist $artist, EntityManagerInterface $entityManager): Response
    {
        try {
            // Check if the musician is authorized to delete the artist
            if ($artist->getMusician() !== $this->getUser()) {
                throw $this->createAccessDeniedException('Vous n\'étes pas autorisé à supprimer cette fiche artiste.');
            }
        } catch (\Exception $e) {
            
            $this->addFlash('error', 'Une erreur s\'est produite lors de la suppression de la fiche artiste.');
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($this->isCsrfTokenValid('delete'.$artist->getId(), $request->request->get('_token'))) {
            $entityManager->remove($artist);
            $entityManager->flush();
        }
        $this->addFlash('success', 'L\'artiste a été supprimé avec succès.');
        return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
    }
}
