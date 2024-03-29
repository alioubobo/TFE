<?php

namespace App\Controller\Admin;

use App\Entity\Coaches;
use App\Entity\Customers;
use App\Entity\Trainings;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        return $this->render('admin/dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ARS');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Coaches', 'fas fa-list', Coaches::class);
        yield MenuItem::linkToCrud('Trainings', 'fas fa-list', Trainings::class);
        yield MenuItem::linkToCrud('Customers', 'fas fa-list', Customers::class);
    }
}
