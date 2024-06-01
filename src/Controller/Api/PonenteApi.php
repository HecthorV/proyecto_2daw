<?php
// src/Controller/Api/PonenteApi.php

namespace App\Controller\Api;

use App\Repository\PonenteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as RouteAnnotation;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[RouteAnnotation("/api/ponentes", name: "ponentes-")]
class PonenteApi extends AbstractController
{
    public function __construct(
        private PonenteRepository $ponenteRepository,
        private SerializerInterface $serializer,
    ){}

    #[RouteAnnotation("/findAll", name: "findAll", methods: ["GET"])]
    public function findAll(): Response
    {
        $ponentes = $this->ponenteRepository->findAll();
        $data = [];
    
        foreach ($ponentes as $ponente) {
            // Accedemos a las propiedades del objeto Ponente utilizando getters
            $data[] = [
                "id" => $ponente->getId(),
                "nombre" => $ponente->getNombre(),
                "cargo" => $ponente->getCargo(),
                "url" => $ponente->getUrl() ?? null,
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