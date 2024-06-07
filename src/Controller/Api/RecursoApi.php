<?php
// src/Controller/Api/RecursoApi.php

namespace App\Controller\Api;

use App\Repository\RecursoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/api/recursos", name: "recursos-")]
class RecursoApi extends AbstractController
{
    public function __construct(
        private RecursoRepository $recursoRepository,
        private SerializerInterface $serializer,
    ){}

    #[Route("/findAll", name: "findAll", methods: ["GET"])]
    public function findAll(): Response
    {
        $recursos = $this->recursoRepository->findAll();
        $data = [];
    
        foreach ($recursos as $recurso) {
            // Accedemos a las propiedades del objeto Recurso utilizando getters
            $data[] = [
                "id" => $recurso->getId(),
                "nombre" => $recurso->getNombre() ?? null,
            ];
        }
    
        // Convertimos el array de datos a formato JSON
        $jsonData = json_encode($data);
    
        // Creamos una nueva respuesta HTTP con el JSON y el tipo de contenido adecuado
        return new Response(
            $jsonData,
            Response::HTTP_OK,
            ['Content-Type' => 'application/json']
        );
    }

}