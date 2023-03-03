<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Entity\Meals;
use App\Entity\Pictures;
use App\Entity\RestaurantHours;
use App\Entity\Categories;
use App\Entity\Menus;
use App\Entity\Formulas;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Quai Antique - Administration')
            ->renderContentMaximized();
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
        yield MenuItem::linkToCrud('Photos', 'fas fa-image', Pictures::class);
        yield MenuItem::subMenu('La Carte', 'fas fa-bread-slice')->setSubItems([
            MenuItem::linkToCrud('Categorie', 'fas fa-plus', Categories::class),
            MenuItem::linkToCrud('Plats', 'fas fa-plus', Meals::class),
            MenuItem::linkToCrud('Menus', 'fas fa-plus', Menus::class),
            MenuItem::linkToCrud('Formules', 'fas fa-plus', Formulas::class),
        ]);
        yield MenuItem::linkToCrud('Horaires', 'fas fa-clock', RestaurantHours::class);
    }
}
