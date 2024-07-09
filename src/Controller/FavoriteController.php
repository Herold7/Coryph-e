<?php

namespace App\Controller;
use App\Entity\Favorite;
use App\Entity\Artist;
use App\Repository\FavoriteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class FavoriteController extends AbstractController
{
    #[Route('/favorites', name: 'favorites', methods: ['GET'])]
    public function index(
        FavoriteRepository $favoriteRepository
        ): Response {

        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        return $this->render('favorite/index.html.twig', [
            'favorites' => $favoriteRepository->findBy([
                'user' => $this->getUser()
            ])
        ]);
    }

    #[Route('/add-favorite/{artist}', name: 'add_favorite', methods: ['GET'])]
    public function addFavorite(
        Artist $artist, 
        Request $request,
        EntityManagerInterface $em
        ): Response {
        
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $previous = $request->headers->get('referer');
        $user = $this->getUser();
        
        $newFavorite = new Favorite();
        $newFavorite->setUser($user);
        $newFavorite->addArtist($artist);

        $user->addFavorite($newFavorite);
        $em->persist($newFavorite);
        $em->flush();

        $this->addFlash('success', 'L\'artiste a été ajouté à vos favoris.');
        return $this->redirect($previous);
    }

    #[Route('/remove-favorite/{artist}', name: 'remove_favorite', methods: ['POST'])]
    public function removeFavorite(
        FavoriteRepository $favoriteRepository,
        EntityManagerInterface $em
    ): Response {
        
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        $favorite = $favoriteRepository->findOneBy([
            'user' => $user
        ]);

        if ($favorite) {
            $user->removeFavorite($favorite);
            $em->persist($user); // Ajouter $em->remove($review)
            $em->remove($favorite);
            $em->flush();
            $this->addFlash('success', 'L\'artiste a été retiré de vos favoris.');
        }

        // Redirect to the last page visited by the user
        return $this->redirectToRoute('account');
    }
}
