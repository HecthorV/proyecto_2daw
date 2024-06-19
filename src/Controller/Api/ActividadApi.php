<?php
// src/Controller/Api/ActividadApi.php

namespace App\Controller\Api;

use App\Entity\Actividad;
use App\Repository\ActividadRepository;
use App\Repository\EspacioRepository;
use App\Repository\EventoRepository;
use App\Service\ActividadService;
use App\Service\SerializeService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route("/api/actividad", name: "actividades-")]
class ActividadApi extends AbstractController
{
    public function __construct(
        private ActividadRepository $actividadRepository,
        private EspacioRepository $espacioRepository,
        private EventoRepository $eventoRepository,
        private EntityManagerInterface $entityManagerInteface,
        private ActividadService $actividadService,
        private SerializeService $serializeService,
    ){}

    // ################################################################################
    // #################################### SELECTS ###################################
    // ################################################################################
    #[Route("/findAlll", name: "findAlll", methods: ["GET"])]
    public function findAlll(): JsonResponse
    {
        $actividades = $this->actividadRepository->findAll();
        $actividadesSerialized = [];
        foreach ($actividades as $actividad) {
            $actividad = $this->serializeService->serializeActividad($actividad);
            $actividadesSerialized[] = $actividad;
        }
        return new JsonResponse($actividadesSerialized, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }
    #[Route("/findAll/completo", name: "findAllCompleto", methods: ["GET"])]
    public function findAllCompleto(): JsonResponse
    {
        $data = $this->actividadRepository->findCompuestasWithHijas();
        return new JsonResponse($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route("/findById/{id}", name: "findById", methods: ["GET"])]//, IsGranted("ROLE_ADMIN")]
    public function findById($id): JsonResponse
    {
        $actividad = $this->actividadRepository->find($id);
        if (!$actividad) {
            return new Response("actividad no encontrada", Response::HTTP_NOT_FOUND);
        }
        $actividadSerialized = $this->serializeService->serializeActividad($actividad);
        return new JsonResponse($actividadSerialized, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    // ################################################################################
    // #################################### INSERTS ###################################
    // ################################################################################
    #[Route("/insert", name: "insert", methods: ["POST"]), IsGranted("ROLE_ADMIN")]
    public function insert_simple(Request $request, ActividadService $actividadService): Response
    {
        $requestData = json_decode($request->getContent(), true); // obtener datos del body

        $newActividadId = $actividadService->insertNewEntity($requestData);

        return new JsonResponse(['id' => $newActividadId], JsonResponse::HTTP_CREATED);
    }

    // ################################################################################
    // #################################### UPDATE ###################################
    // ################################################################################
    #[Route("/update", name: "update", methods: ["POST"])]//, IsGranted("ROLE_ADMIN")]
    public function update(Request $request): Response
    {
        $requestData = json_decode($request->getContent(), true);
        $this->actividadService->update($requestData);
        return new JsonResponse(true, JsonResponse::HTTP_CREATED);
    }
}