<?php
// src/Service/RouteService.php

namespace App\Service;

use App\Entity\Actividad;
use App\Entity\DetalleActividad;
use App\Entity\Item;
use App\Entity\Route;
use App\Repository\EspacioRepository;
use App\Repository\GrupoRepository;
use App\Repository\PonenteRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActividadService
{
//    private $entityManager;

    private EspacioRepository $espacioRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        EspacioRepository      $espacioRepository,
        PonenteRepository      $ponenteRepository,
        GrupoRepository        $grupoRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->espacioRepository = $espacioRepository;
        $this->grupoRepository = $grupoRepository;
    }


    public function insertNewEntity($requestData): int
    {

        $description = $requestData['descripcion'] ?? null;
        $fechaHoraInicio = $requestData['fechaHoraInicio'] ?? null;
        $fechaHoraFin = $requestData['fechaHoraFin'] ?? null;

        $actividad = new Actividad();
        $actividad->setNombre($description);
        $actividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
        $actividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
        $actividad->setCompuesta($requestData['isCompuesta']);

        if (!$requestData['isCompuesta']) {
            $aforo = $requestData['aforo'] ?? null;

            $detalleActividad = new DetalleActividad();
//            $detalleActividad->setEspacio();

            $espaciosIds = $requestData["espacios"] ?? null;
            $espaciosArr = [];
            foreach ($espaciosIds as $espacioId) {
                $espacio = $this->espacioRepository->find($espacioId);
                $espaciosArr[] = $espacio;
            }

            $gruposIds = $requestData["grupos"] ?? null;
            $gruposArr = [];
            foreach ($gruposIds as $grupoId) {
                $grupo = $this->grupoRepository->find($grupoId);
                $gruposArr[] = $grupo;
            }

            dd($espaciosArr
                ,$gruposArr);


            $actividad->setAforo($aforo);

        }

        $this->entityManager->persist($actividad);
        $this->entityManager->flush();

        return $actividad->getId();
    }


}
