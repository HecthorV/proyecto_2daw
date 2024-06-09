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
    #[Route("/findAll", name: "findAll", methods: ["GET"])]
    public function findAll(): Response
    {
        $actividades = $this->actividadRepository->findAll();
        $actividadesSerialized = [];
        foreach ($actividades as $actividad) {
            $actividad = $this->serializeService->serializeActividad($actividad);
            $actividadesSerialized[] = $actividad;
        }
        $data = json_encode($actividadesSerialized);
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[Route("/findById/{id}", name: "findById", methods: ["GET"])]
    public function findById($id): Response
    {
        $route = $this->actividadRepository->find($id);
        if (!$route) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $data = json_encode($route, 'json');
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    // ################################################################################
    // #################################### INSERTS ###################################
    // ################################################################################
    #[Route("/insert", name: "insert", methods: ["POST"]), IsGranted("ROLE_ADMIN")]
    public function insert_simple(Request $request, ActividadService $actividadService): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $newActividadId = $actividadService->insertNewEntity($requestData);

        return new JsonResponse(['id' => $newActividadId], JsonResponse::HTTP_CREATED);
    }

    // ################################################################################
    // #################################### UPDATE ###################################
    // ################################################################################
    #[Route("/update", name: "update", methods: ["POST"]), IsGranted("ROLE_ADMIN")]
    public function update(Request $request): Response
    {
        $requestData = json_decode($request->getContent(), true);
        $this->actividadService->update($requestData);
        return new JsonResponse(true, JsonResponse::HTTP_CREATED);
    }

    // #[Route("/update/{id}", name: "updateById", methods: ["PUT"])]
    // public function updateById(Request $request, $id): Response
    // {
    //     $route = $this->routeRepository->find($id);
    //     if (!$route) {
    //         return new Response(null, Response::HTTP_NOT_FOUND);
    //     }
    //     $data = json_decode($request->getContent(), true);
    //     // Aquí puedes actualizar la entidad Route con los datos recibidos en $data
    // }

    // #[Route("/delete/{id}", name: "delete", methods: ["DELETE"])]
    // public function delete($id): Response
    // {
    //     $entityManager = $this->routeRepository->getManager();
    //     $route = $entityManager->getRepository(Route::class)->find($id);
    //     if (!$route) {
    //         return new Response(null, Response::HTTP_NOT_FOUND);
    //     }
    //     $entityManager->remove($route);
    //     $entityManager->flush();
    //     return new Response(null, Response::HTTP_OK);
    // }
}