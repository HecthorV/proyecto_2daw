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

        if ($requestData['isCompuesta']) {

            $detalleActividad = new DetalleActividad();
            $detalleActividad->setNombre($description);
            $detalleActividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
            $detalleActividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
            $detalleActividad->setActividad($actividad);

            $this->entityManager->persist($detalleActividad);
            $this->entityManager->flush();

            $this->entityManager->persist($actividad);
            $this->entityManager->flush();

            return $actividad->getId();
        } else {

            $detalleActividad = new DetalleActividad();

//            $aforo = $requestData['aforo'] ?? null;

            $idActividad = $requestData['id_actividad'] ?? null;
            $actividadPadre = $this->actividadRepository->find($idActividad);

            $espaciosIds = $requestData["espacios"] ?? null;
            foreach ($espaciosIds as $espacioId) {
                $espacio = $this->espacioRepository->find($espacioId);
                $detalleActividad->addEspacio($espacio);
            }

            $gruposIds = $requestData["grupos"] ?? null;
            foreach ($gruposIds as $grupoId) {
                $grupo = $this->grupoRepository->find($grupoId);
                $detalleActividad->addGrupo($grupo);
            }


            $detalleActividad->setNombre($description);
            $detalleActividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
            $detalleActividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
            $detalleActividad->setActividad($actividadPadre);

            $this->entityManager->persist($detalleActividad);
            $this->entityManager->flush();

            return $detalleActividad->getId();
        }
    }


}
