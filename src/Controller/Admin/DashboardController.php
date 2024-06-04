<?php

namespace App\Controller\Admin;

use App\Entity\Actividad;
use App\Entity\Alumno;
use App\Entity\DetalleActividad;
use App\Entity\Edificio;
use App\Entity\Espacio;
use App\Entity\Evento;
use App\Entity\Grupo;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        // return parent::index();
        $this->configureDashboard();
        $this->configureMenuItems();
        $this->configureActions();
        return $this->render('admin/admin.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Proyecto');
    }

    // TODO introducirlo a EASY ADMIN
    #[Route('/crear-actividad', name: 'app-crear-actividad')]
    public function crear_actividad(): Response
    {
        // return parent::index();
        // $this->configureDashboard();
        // $this->configureMenuItems();
        return $this->render('admin/actividad/crear-actividad.html.twig');
    }

    public function configureMenuItems(): iterable
    {
        // yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        // // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);

        yield MenuItem::section('Usuarios');
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-users', User::class);
        
        yield MenuItem::section('Funciones');
        yield MenuItem::linkToCrud('Actividades', 'fas fa-list-check', Actividad::class); //$this->generateUrl('create-activity')

        yield MenuItem::section('Entidades');
        // yield MenuItem::linkToCrud('Actividades', 'fas fa-list-check', Actividad::class);
        yield MenuItem::linkToCrud('Alumnos', 'fas fa-users', Alumno::class);
        yield MenuItem::linkToCrud('Edificios', 'fas fa-users', Edificio::class);
        yield MenuItem::linkToCrud('Espacios', 'fas fa-users', Espacio::class);
        yield MenuItem::linkToCrud('Eventos', 'fas fa-users', Evento::class);
        yield MenuItem::linkToCrud('Grupos', 'fas fa-users', Grupo::class);

        yield MenuItem::section('Zonas de mi web');
        yield MenuItem::linkToRoute('Inicio', 'fa fa-home', 'app_home'); // TODO mejorar la URL
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
    
}
