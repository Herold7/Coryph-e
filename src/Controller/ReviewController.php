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
    #[Route('/review/{id}', name: 'review_show', methods: ['GET'])]
    public function show(
        Review $review
    ): Response{
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        return $this->render('review/show.html.twig', [
            'review' => $review
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

        return $this->render('review/new.html.twig', [
            'artist' => $artist,
            'formReview' => $formReview->createView(),
        ]);
    }

    #[Route('/edit-review/{id}', name: 'edit_review', methods: ['GET', 'POST'])]
    public function editReview(
        Request $request, 
        Review $review, 
        EntityManagerInterface $em
        ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        try{
            if ($review->getUser() !== $this->getUser()) {
                throw $this->createAccessDeniedException('Vous n\'êtes pas autorisé à modifier cet avis.');
            }
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('reviews');
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
            'formReview' => $formReview->createView(),
        ]);
    }

    #[Route('/remove-review/{id}', name: 'remove_review', methods: ['GET', 'POST'])]
    public function removeReview(
        ReviewRepository $ReviewRepository, 
        EntityManagerInterface $em
        ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }
        
        $user = $this->getUser();
        $review = $ReviewRepository->findOneBy([
            'user' => $user
        ]);

        if ($review) {
            $user->removeReview($review);
            $em->persist($user); // Ajouter $em->remove($review)
            $em->remove($review);
            $em->flush();
            $this->addFlash('success', 'L\'avis a été retiré avec succès.');
        }
        return $this->redirectToRoute('account');
    }
}
