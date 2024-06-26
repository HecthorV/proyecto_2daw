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
use App\Repository\ActividadRepository;
use App\Repository\DetalleActividadRepository;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Assets;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Request;
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

    #[Route('/crear-actividad', name: 'app-crear-actividad')]
    public function crear_actividad(): Response
    {
        return $this->render('admin/actividad/crear-actividad.html.twig');
    }

    // EDITAR SIMPLE
    #[Route('/editar-actividad', name: 'app-editar-actividad')]
    public function editar_actividad(Request $request, DetalleActividadRepository $actividadRepository): Response
    {
        $id = $request->query->get('id');
        $detalleActividad = $actividadRepository->find($id);
        $idEvento = $request->query->get('idEvento');
        $aforo = $request->query->get('aforo');

        return $this->render('admin/actividad/editar/editar-actividad-simple.html.twig',[
            'id' => $id,
            'detalleActividad' => $detalleActividad,
            'idEvento' => $idEvento == "" || $idEvento == null ? 0 : $idEvento,
            'aforo' => $aforo
        ]);
    }

    // EDITAR COMPUESTA
    #[Route('/editar-actividad-compuesta', name: 'app-editar-actividad-compuesta')]
    public function editar_actividad_compuesta(Request $request, DetalleActividadRepository $detalleActividadRepository): Response
    {
        $id = $request->query->get('id');
        $detalleActividad = $detalleActividadRepository->find($id);
        $idEvento = $request->query->get('idEvento');

        return $this->render('admin/actividad/editar/editar-actividad-compuesta.html.twig',[
            'id' => $id,
            'detalleActividad' => $detalleActividad,
            'idEvento' => $idEvento
        ]);
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::section('Usuarios');
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-users', User::class);
        
        yield MenuItem::section('Funciones');
       yield MenuItem::linkToCrud('Actividades', 'fa-solid fa-chart-line', Actividad::class); //$this->generateUrl('create-activity')
        yield MenuItem::linkToCrud('Lista de actividades', 'fas fa-list-check', DetalleActividad::class); //$this->generateUrl('create-activity')

        yield MenuItem::section('Entidades');
        yield MenuItem::linkToCrud('Alumnos', 'fas fa-users', Alumno::class);
        yield MenuItem::linkToCrud('Edificios', 'fas fa-users', Edificio::class);
        yield MenuItem::linkToCrud('Espacios', 'fas fa-users', Espacio::class);
        yield MenuItem::linkToCrud('Eventos', 'fas fa-users', Evento::class);
        yield MenuItem::linkToCrud('Grupos', 'fas fa-users', Grupo::class);

        yield MenuItem::section('Zonas de mi web');
        yield MenuItem::linkToUrl('Home', 'fas fa-home', "/home");
    }

    public function configureActions(): Actions
    {
        return parent::configureActions()
        ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }

    public function configureAssets(): Assets
    {
        return Assets::new()
            ->addCssFile('css/easyadmin/estilosprincipales.css')
            ->addJsFile('js/easyadmin/admin.js')
            ;
    }
    
}
