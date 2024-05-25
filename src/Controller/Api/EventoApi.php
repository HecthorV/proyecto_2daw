<?php
// src/Controller/Api/EventoApi.php

namespace App\Controller\Api;

use App\Repository\EventoRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as RouteAnnotation;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[RouteAnnotation("/api/eventos", name: "route-")]
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
    #[RouteAnnotation("/findAll", name: "findAll", methods: ["GET"])]
    public function findAll(): Response
    {
        $events = $this->eventoRepository->findAll();
        // $data = json_encode($events, 'json');
        $data = $this->serializer->serialize($events, 'json');
        return new Response(
            $data, 
            Response::HTTP_OK, 
            ['Content-Type' => 'application/json']
        );
    }

}