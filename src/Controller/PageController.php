<?php

namespace App\Controller;

use App\Form\ProfileType;
use App\Service\ProfileService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;

class PageController extends AbstractController
{
    
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('page/index.html.twig', [
            'controller_name' => 'PageController',
        ]);
    }

    #[Route('/chant', name: 'chant', methods: ['GET'])]
    public function Chant(): Response
    {
        return $this->render('page/category.html.twig', [
            'title' => 'chant',
            'category' => 'chant',
            'description' => 'Vous recherchez un chanteur ou une chanteuse pour votre événement ? Vous êtes au bon endroit !',
        ]);
    }

    #[Route('/musicien', name: 'musician', methods: ['GET'])]
    public function Musicien(): Response
    {
        return $this->render('page/category.html.twig', [
            'title' => 'Musicien',
            'category' => 'musicien',
            'description' => 'Vous recherchez un musicien pour votre événement ? Vous êtes au bon endroit !',
        ]);
    }

    #[Route('/groupe', name: 'groupe', methods: ['GET'])]
    public function groupe(): Response
    {
        return $this->render('page/category.html.twig', [
            'title' => 'groupe',
            'category' => 'groupe',
            'description' => 'Vous recherchez groupe de musique pour votre événement ? Vous êtes au bon endroit !',
        ]);
    }


}

