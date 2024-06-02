<?php
// src/Controller/Api/EspacioApi.php

namespace App\Controller\Api;

use App\Entity\Espacio;
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

    #[RouteAnnotation('/findByIdsRecursos', name: 'find_by_recursos', methods: ['GET'])]
    public function findByRecursos(Request $request): JsonResponse
    {
        $recursosIds = $request->headers->get('X-Recurso-Ids');

        $recursosIdsArray = explode(',', $recursosIds);

        $espacios = [];
        foreach ($recursosIdsArray as $idEvento) { // arrayDeIds as id
            $espacio = $this->espacioRepository->find($idEvento);
            if ($espacio !== null) {
                $espacios[] = $this->serializeEspacio($espacio);
            }
        }

        return new JsonResponse($espacios, Response::HTTP_OK);
    }

    public function serializeEspacio(Espacio $espacio): array
    {
        return [
            'id' => $espacio->getId(),
            'nombre' => $espacio->getNombre(),
            'aforo' => $espacio->getAforo(),
            'edificio' => $espacio->getEdificio(),
        ];
    }

}