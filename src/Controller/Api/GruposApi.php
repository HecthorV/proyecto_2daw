<?php
// src/Controller/Api/GrupoApi.php

namespace App\Controller\Api;

use App\Entity\Grupo;
use App\Repository\GrupoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as RouteAnnotation;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[RouteAnnotation("/api/grupos", name: "grupos-")]
class GruposApi extends AbstractController
{
    public function __construct(
        private GrupoRepository $grupoRepository,
        private SerializerInterface $serializer,
    ){}

    #[RouteAnnotation('/findAll', name: 'findAll', methods: ['GET'])]
    public function findAll(): Response
    {
        $grupos = $this->grupoRepository->findAll();
        $data = [];

        foreach ($grupos as $grupo) {
            // Accedemos a las propiedades del objeto Ponente utilizando getters
            $data[] = [
                "id" => $grupo->getId(),
                "nombre" => $grupo->getNombre(),
                "cargo" => $grupo->getCurso(),
                "letra" => $grupo->getLetra(),
                "nivelEducativo" => $grupo->getNivelEducativo(),
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