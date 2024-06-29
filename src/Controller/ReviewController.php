<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ArtistRepository;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    #[Route('/review', name: 'review', methods: ['GET'])]
    public function index(
        ReviewRepository $reviewRepository
    ): Response
    {
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('review/index.html.twig', [
            'reviews' => $reviewRepository->findBy([
                'user' => $this->getUser()
            ])
        ]);
    }

    #[Route('/add-review/{artist}', name: 'add_review', methods: ['GET', 'POST'])]
    public function addReview(
        Artist $artist,
        ArtistRepository $artistRepository, 
        Request $request,
        EntityManagerInterface $em
        ): Response
    {
        
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $previous = $request->headers->get('referer');
        
        $review = new Review();
        $review->setUser($this->getUser());
        $review->$artistRepository->find($artist);

        $form= $this->Createform(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
        $em->persist($review);
        $em->flush();

        $this->addFlash('success', 'L\'avis a été ajouté.');
        return $this->redirect($previous);
    }
    return $this->render('review/index.html.twig', [
        'form' => $form->createView(),
    ]);
}

#[Route('/edit-review/{artist}', name: 'edit_review', methods: ['GET', 'POST'])]// Route pour modifier un artiste
    public function edit(Request $request, Review $review, EntityManagerInterface $em): Response
    {
        try {
            // Vérifiez si l'utilisateur est autorisé à modifier l'avis
            if ($review->getUser() !== $this->getUser()) {
                throw $this->createAccessDeniedException('Vous n\'étes pas autorisé à modifier cet avis.');
            }
        } catch (\Exception $e) {// Récupère l'erreur
            
            $this->addFlash('error', 'Une erreur s\'est produite lors de la modification de l\'avis.');
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        $form = $this->createForm(ReviewType::class, $review);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();

            $this->addFlash('success', 'La fiche artiste a été modifié avec succès.');
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('artist/edit.html.twig', [
            'review' => $review,
            'form' => $form,
        ]);
    }

    #[Route('/remove-review/{artist}', name: 'remove_review', methods: ['POST'])]
    public function removeFavorite(
        Request $request,
        Review $review,
        EntityManagerInterface $em
    ): Response
    {
        try {
            // Check if the user is authorized to delete the artist
            if ($review->getUser() !== $this->getUser()) {
                throw $this->createAccessDeniedException('Vous n\'étes pas autorisé à supprimer cet avis.');
            }
        } catch (\Exception $e) {
            
            $this->addFlash('error', 'Une erreur s\'est produite lors de la suppression de cet avis.');
            return $this->redirectToRoute('app_artist_index', [], Response::HTTP_SEE_OTHER);
        }

        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $em->remove($review);
            $em->flush();
        }
        $this->addFlash('success', 'L\'artiste a été supprimé avec succès.');
        return $this->redirectToRoute('account', [], Response::HTTP_SEE_OTHER);
    }
}
