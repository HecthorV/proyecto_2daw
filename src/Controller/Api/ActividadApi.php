<?php
// src/Controller/Api/ActividadApi.php

namespace App\Controller\Api;

use App\Entity\Actividad;
use App\Entity\Route;
use App\Repository\ActividadRepository;
use App\Service\RouteService;
use Doctrine\ORM\EntityManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as RouteAnnotation;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[RouteAnnotation("/api/actividad", name: "route-")]
class ActividadApi extends AbstractController
{
    public function __construct(
        private ActividadRepository $actividadRepository,
        private EntityManager $entityManager,
    ){}

    // ################################################################################
    // #################################### SELECTS ###################################
    // ################################################################################
    #[RouteAnnotation("/findAll", name: "findAll", methods: ["GET"])]
    public function findAll(): Response
    {
        $routes = $this->actividadRepository->findAll();
        $data = json_encode($routes, 'json');
        // new Response(cuerpo, código de status, cabeceras);
        return new Response($data, Response::HTTP_OK, ['Content-Type' => 'application/json']);
    }

    #[RouteAnnotation("/findById/{id}", name: "findById", methods: ["GET"])]
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
    #[RouteAnnotation("/insert", name: "insert", methods: ["POST"])]//, IsGranted("ROLE_TEACHER")]
    public function insert(Request $request): Response
    {
        // $requestData = $request->request->all();
        $requestData = json_decode($request->getContent(), true);

        $nombre = $request->request->get("nombre");
        $fechaHoraInicio = $request->request->get("fechaHoraInicio");
        $fechaHoraFin = $request->request->get("fechaHoraFin");
        $isCompuesta = $request->request->get("isCompuesta");
        $evento = 1;

        $actividad = new Actividad();
        $actividad->setNombre($nombre);
        $actividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
        $actividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
        $actividad->setCompuesta($isCompuesta);
        // TODO ponenetes
        // TODO aforo => espacios
        // TODO recibir grupos
        
        $evento = new Evento
        // Buscar esta entidad $evento en el repositorio
        $entityManager->find
        $actividad->setEvento($evento);

        $this->actividadRepository->persist($actividad);
        $actividad_id = $this->actividadRepository->flush($actividad);
        
        dump($actividad_id);
        dd($actividad);
        return new JsonResponse(['id' => $actividad->getId()], JsonResponse::HTTP_CREATED);        
    }

    #[RouteAnnotation("/insertAndGenerateTours", name: "insertAndGenerateTours", methods: ["POST"]), IsGranted("ROLE_TEACHER")]
    public function insertAndGenerateTours(Request $request, RouteService $routeService): Response
    {
        // Llamar al servicio 'route_service' que inserta los datos y devuelve el ID de la nueva entidad creada
        $newEntityId = $routeService->insertNewEntityAndGenerateTours($request);

        // Devolver una respuesta adecuada
        return new JsonResponse(['id' => $newEntityId], JsonResponse::HTTP_CREATED);

        // TODO por si no funciona crear ruta
        // return $this->redirectToRoute('admin');
        return $this->redirect('http://localhost:8000/admin?crudAction=index&crudControllerFqcn=App%5CController%5CAdmin%5CRouteCrudController');
    }

    // ################################################################################
    // #################################### UPDATE ###################################
    // ################################################################################
    #[RouteAnnotation("/update", name: "update", methods: ["POST"]), IsGranted("ROLE_GUIDE")]
    public function update(Request $request): Response
    {
        if (!$this->routeService->update($request)) 
        {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        return $this->redirect('http://localhost:8000/admin?crudAction=index&crudControllerFqcn=App%5CController%5CAdmin%5CRouteCrudController');
    }

    #[RouteAnnotation("/update/{id}", name: "updateById", methods: ["PUT"])]
    public function updateById(Request $request, $id): Response
    {
        $route = $this->routeRepository->find($id);
        if (!$route) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $data = json_decode($request->getContent(), true);
        // Aquí puedes actualizar la entidad Route con los datos recibidos en $data
    }

    #[RouteAnnotation("/delete/{id}", name: "delete", methods: ["DELETE"])]
    public function delete($id): Response
    {
        $entityManager = $this->routeRepository->getManager();
        $route = $entityManager->getRepository(Route::class)->find($id);
        if (!$route) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $entityManager->remove($route);
        $entityManager->flush();
        return new Response(null, Response::HTTP_OK);
    }

    #[RouteAnnotation("/existsByLocality/{id}", name: "updateByLocality", methods: ["GET"])]
    public function existsByLocality(Request $request, $id): Response
    {
        $route = $this->routeRepository->findByLocality($id);
        if (!$route) {
            return new Response(null, Response::HTTP_NOT_FOUND);
        }
        $data = json_decode($request->getContent(), true);
        // Aquí puedes actualizar la entidad Route con los datos recibidos en $data
    }
}