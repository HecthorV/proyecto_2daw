<?php

namespace App\Controller;

use App\Repository\GrupoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/personas', name: 'app_persona-')]
class PersonaController extends AbstractController
{
    #[Route('/alta_masiva', name: 'alta_masiva')]
    public function alta_masiva(): Response
    {
        return $this->render('alta_masiva.html.twig');
    }
}
