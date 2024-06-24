<?php

namespace App\Controller\Admin;

use App\Entity\Set;
use App\Entity\User;
use App\Entity\Artist;
use App\Entity\Category;
use App\Entity\EventPlatform;
use App\Entity\Instrument;
use App\Entity\Performance;
use App\Entity\MusicalStyle;
use App\Entity\MusicPlatform;
use App\Entity\SocialNetwork;
use App\Entity\Tag;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        // $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        // return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        return $this->render('user/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('<img src="/images/logo/logo-noir2.jpeg" width="50">')
            ->setFaviconPath('/images/logo/logo-noir2.jpeg')
            ->renderContentMaximized();
    }


    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fa fa-users', User::class);
        yield MenuItem::linkToCrud('Musiciens', 'fa fa-microphone', Artist::class);
        yield MenuItem::linkToCrud('Categories', 'fa fa-list', Category::class);
        yield MenuItem::linkToCrud('Instruments', 'fa fa-guitar', Instrument::class);
        yield MenuItem::linkToCrud('Style musicaux', 'fa fa-headphones', MusicalStyle::class);
        yield MenuItem::linkToCrud('Prestations', 'fa fa-play', Performance::class);
        yield MenuItem::linkToCrud('Ensemble', 'fa fa-compact-disc', Set::class);
        yield MenuItem::linkToCrud('Tags', 'fa fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Plateformes Evenementielles', 'fa fa-icons', EventPlatform::class);
        yield MenuItem::linkToCrud('Plateformes Musicales', 'fa-brands fa-soundcloud', MusicPlatform::class);
        yield MenuItem::linkToCrud('Réseaux sociaux', 'fa fa-podcast', SocialNetwork::class);
    
    // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    yield MenuItem::linkToRoute('Retour à l\'accueil', 'fa fa-arrow-left', 'app_home');
    }
}
