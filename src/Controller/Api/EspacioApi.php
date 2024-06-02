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

    #[RouteAnnotation('/findByIdsRecursos', name: 'find_by_recursos', methods: ['GET'])]
    public function findByRecursos(Request $request, EspacioRepository $espacioRepository): Response
    {
        // Obtener los IDs de Recurso de los parámetros de la cabecera
        $recursosIds = $request->headers->get('X-Recurso-Ids');

        // Convertir los IDs de Recurso en un array
        $recursosIdsArray = explode(',', $recursosIds);

        dump($recursosIdsArray);
        $eventos = [];
        foreach ($recursosIdsArray as $idEvento) {
            $eventos[] = $this->espacioRepository->find($idEvento);
        }
//        $arrIdsEspacios = $this->espacioRepository->findByIdsRecursos($recursosIdsArray);
        dd($eventos);

        // Buscar los espacios que contienen todos los recursos especificados
        $espacios = $this->espacioRepository->findByRecursos($recursosIdsArray);

        // Convertir los resultados en un formato JSON y devolverlos
        return $this->json($espacios);
    }

}