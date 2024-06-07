<?php
// src/Controller/Api/EventoApi.php

namespace App\Controller\Api;

use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[Route("/api/eventos", name: "eventos-")]
class EventoApi extends AbstractController
{
    public function __construct(
        private EventoRepository $eventoRepository,
        // private EntityManager $entityManager,
        private SerializerInterface $serializer,
    ){}

    // ################################################################################
    // #################################### SELECTS ###################################
    // ################################################################################
    #[Route("/findAll", name: "findAll", methods: ["GET"])]
    public function findAll(): Response
    {
        $events = $this->eventoRepository->findAll();
        $data = [];
    
        foreach ($events as $event) {
            // Accedemos a las propiedades del objeto Evento utilizando getters
            $data[] = [
                "id" => $event->getId(),
                "nombre" => $event->getNombre(),
                "fechaInicio" => $event->getFechaInicio()->format('Y-m-d'),
                "fechaFin" => $event->getFechaFin() ?? null,
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