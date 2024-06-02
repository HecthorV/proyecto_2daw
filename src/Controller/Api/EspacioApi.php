<?php
// src/Controller/Api/EspacioApi.php

namespace App\Controller\Api;

use App\Repository\EspacioRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route as RouteAnnotation;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\Serializer\SerializerInterface;

#[RouteAnnotation("/api/espacios", name: "espacios-")]
class EspacioApi extends AbstractController
{
    public function __construct(
        private EspacioRepository $espacioRepository,
        private SerializerInterface $serializer,
    ){}

    #[RouteAnnotation("/findByEspacios", name: "findByEspacios", methods: ["GET"])]
    public function findByEspacios(Request $request): Response
    {
        // Obtenemos los IDs de los espacios desde los headers
        $selectedIds = $request->headers->get('X-Selected-Ids');

        if (!$selectedIds) {
            return new JsonResponse(['error' => 'No IDs provided'], Response::HTTP_BAD_REQUEST);
        }

        $idsArray = explode(',', $selectedIds);

        // Buscamos los espacios por los IDs
        $espacios = $this->espacioRepository->findBy(['id' => $idsArray]);

        $data = [];

        foreach ($espacios as $espacio) {
            $data[] = [
                "id" => $espacio->getId(),
                "nombre" => $espacio->getNombre() ?? null,
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