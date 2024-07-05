<?php

namespace App\Controller;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PageController extends AbstractController
{
    
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/chanteur', name: 'chanteur', methods: ['GET'])]
    public function Chanteur(): Response
    {
        return $this->render('page/category.html.twig', [
            'title' => 'chanteur',
            'category' => 'chanteur',
            'background' => 'chanteur',
            'description' => 'Vous recherchez un chanteur ou une chanteuse pour votre événement ? Vous êtes au bon endroit !',
        ]);
    }

    #[Route('/musicien', name: 'musician', methods: ['GET'])]
    public function Musicien(): Response
    {
        return $this->render('page/category.html.twig', [
            'title' => 'Musicien',
            'category' => 'musicien',
            'background' => 'musicien',
            'description' => 'Vous recherchez un musicien pour votre événement ? Vous êtes au bon endroit !',
        ]);
    }

    #[Route('/groupe', name: 'groupe', methods: ['GET'])]
    public function groupe(): Response
    {
        return $this->render('page/category.html.twig', [
            'title' => 'groupe',
            'category' => 'groupe',
            'background' => 'groupe',
            'description' => 'Vous recherchez un groupe de musique pour votre événement ? Vous êtes au bon endroit !',
        ]);
    }
}

