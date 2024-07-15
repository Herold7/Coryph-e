<?php

namespace App\Controller;

use App\Entity\Artist;
use App\Entity\Review;
use App\Form\ReviewType;
use App\Repository\ReviewRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReviewController extends AbstractController
{
    #[Route('/reviews', name: 'reviews', methods: ['GET'])]
    public function index(ReviewRepository $reviewRepository): Response
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
        Request $request, 
        EntityManagerInterface $em
        ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        $review = new Review();
        $review->setUser($this->getUser());
        $review->setArtist($artist);

        $formReview = $this->createForm(ReviewType::class, $review);
        $formReview->handleRequest($request);

        if ($formReview->isSubmitted() && $formReview->isValid()) {
            $em->persist($review);
            $em->flush();

            $this->addFlash('success', 'L\'avis a été ajouté.');
            return $this->redirectToRoute('app_artist_show', ['id' => $artist->getId()]);
        }

        return $this->render('artist/show.html.twig', [
            'artist' => $artist,
            'form' => $formReview->createView(),
        ]);
    }

    #[Route('/edit-review/{review}', name: 'edit_review', methods: ['GET', 'POST'])]
    public function editReview(
        Request $request, 
        Review $review, 
        EntityManagerInterface $em
        ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($review->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à modifier cet avis.');
        }

        $formReview = $this->createForm(ReviewType::class, $review);
        $formReview->handleRequest($request);

        if ($formReview->isSubmitted() && $formReview->isValid()) {
            $em->flush();

            $this->addFlash('success', 'L\'avis a été modifié avec succès.');
            return $this->redirectToRoute('reviews');
        }

        return $this->render('review/edit.html.twig', [
            'review' => $review,
            'form' => $formReview->createView(),
        ]);
    }

    #[Route('/remove-review/{review}', name: 'remove_review', methods: ['GET, POST'])]
    public function removeReview(
        Request $request, 
        Review $review, 
        EntityManagerInterface $em
        ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        if ($review->getUser() !== $this->getUser()) {
            throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à supprimer cet avis.');
        }

        if ($this->isCsrfTokenValid('delete'.$review->getId(), $request->request->get('_token'))) {
            $em->remove($review);
            $em->flush();
            $this->addFlash('success', 'L\'avis a été deleteimé avec succès.');
        } else {
            $this->addFlash('error', 'Une erreur s\'est produite lors de la deleteession de cet avis.');
        }

        return $this->redirectToRoute('account');
    }
}
