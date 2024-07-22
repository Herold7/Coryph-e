<?php

namespace App\Controller;

use App\Form\ProfileType;// importer la classe ProfileType qui permet de gérer le formulaire de profil utilisateur
use App\Service\ProfileService;// importer la classe ProfileService qui permet de gérer le profil utilisateur
use Doctrine\ORM\EntityManagerInterface;// importer la classe EntityManagerInterface qui permet de gérer les entités
use Symfony\Component\HttpFoundation\Request;// importer la classe Request qui permet de gérer les requêtes HTTP
use Symfony\Component\HttpFoundation\Response;// importer la classe Response qui permet de gérer les réponses HTTP
use Symfony\Component\Routing\Annotation\Route;// importer la classe Route qui permet de définir les routes
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;// importer la classe AbstractController qui est une classe de base pour les contrôleurs

class UserController extends AbstractController
{
    #[Route('/complete-profile', name: 'complete_profile')]
    public function index(
        Request $request,
        ProfileService $profileService,
        EntityManagerInterface $em
    ): Response {

        $form = $this->createForm(ProfileType::class);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()) {
            $profileService->updateProfile($form, $this->getUser(), $em);
            
            $this->addFlash('success', 'Votre profil a été modifié');
            return $this->redirectToRoute('account');
        }
        return $this->render('user/profile.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * User account route for displaying it's own data on the app
     */
    #[Route('/account', name: 'account', methods: ['GET', 'POST'])]
    public function account(
        Request $request,
        EntityManagerInterface $em,
        ProfileService $profileService
    ): Response {
        
        if (!$this->getUser()) {
            return $this->redirectToRoute('app_login');
        }

        $form = $this->createForm(ProfileType::class, $this->getUser());
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $profileService->updateProfile($form, $this->getUser(), $em);
            $this->addFlash('success', 'Votre profil a été mis à jour');
            return $this->redirectToRoute('account');
        }
        return $this->render('user/account.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
