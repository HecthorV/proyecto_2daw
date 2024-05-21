<?php

namespace App\Controller;

use App\Repository\GrupoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/actividad', name: 'app_actividad-')]
class ActividadController extends AbstractController
{
    #[Route('/formulario', name: 'formulario')]
    public function formulario(): Response
    {
        return $this->render('actividad/form.html.twig', [
            // 'controller_name' => 'ActividadController',
        ]);
    }

    // TODO inyectarlo al panel de administrador
    #[Route('/crear', name: 'crear')]
    public function crear_actividad(GrupoRepository $grupoRepository): Response
    {
        // $data = $grupoRepository->findAll();
        // return $this->render('admin/actividad/crear-actividad.html.twig'
        return $this->render('admin/actividad/list.html.twig'
            // , [ 'grupos' => $data ]
        );
    }
}
