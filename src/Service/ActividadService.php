<?php
// src/Service/RouteService.php

namespace App\Service;

use App\Entity\Actividad;
use App\Entity\DetalleActividad;
use App\Entity\Item;
use App\Entity\Ponente;
use App\Entity\Route;
use App\Repository\ActividadRepository;
use App\Repository\DetalleActividadRepository;
use App\Repository\EspacioRepository;
use App\Repository\EventoRepository;
use App\Repository\GrupoRepository;
use App\Repository\PonenteRepository;
use Doctrine\ORM\EntityManagerInterface;

class ActividadService
{
//    private $entityManager;

    private EspacioRepository $espacioRepository;

    public function __construct(
        EntityManagerInterface $entityManager,
        ActividadRepository    $actividadRepository,
        DetalleActividadRepository $detalleActividadRepository,
        EspacioRepository      $espacioRepository,
        PonenteRepository      $ponenteRepository,
        GrupoRepository        $grupoRepository,
        EventoRepository       $eventoRepository
    )
    {
        $this->entityManager = $entityManager;
        $this->actividadRepository = $actividadRepository;
        $this->detalleActividadRepository = $detalleActividadRepository;
        $this->espacioRepository = $espacioRepository;
        $this->ponenteRepository = $ponenteRepository;
        $this->grupoRepository = $grupoRepository;
        $this->eventoRepository = $eventoRepository;
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

            $idEvento = $requestData['idEvento'] ?? null;
            if ($idEvento != null) {
                $evento = $this->eventoRepository->find($idEvento);
                $actividad->setEvento($evento);
            }

            $this->entityManager->persist($actividad);

            $detalleActividad = new DetalleActividad();
            $detalleActividad->setNombre($description);
            $detalleActividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
            $detalleActividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
            $detalleActividad->setActividad($actividad);

            $this->entityManager->persist($detalleActividad);
            $this->entityManager->flush();

            $this->entityManager->flush();

            return $actividad->getId();
        } else {
            $this->entityManager->persist($actividad);

            $detalleActividad = new DetalleActividad();

            $idActividad = $requestData['idActividadPadre'] ?? null;

//            $espaciosIds = $requestData["espacios"] ?? null;
//            foreach ($espaciosIds as $espacioId) {
//                $espacio = $this->espacioRepository->find($espacioId);
//                $detalleActividad->addEspacio($espacio);
//            }
            $idEspacio = $requestData["idEspacio"] ?? null;
            $espacio = $this->espacioRepository->find($idEspacio);
            $detalleActividad->setEspacio($espacio);

            $gruposIds = $requestData["grupos"] ?? null;
            foreach ($gruposIds as $grupoId) {
                $grupo = $this->grupoRepository->find($grupoId);
                $detalleActividad->addGrupo($grupo);
            }

            $ponentesJson = $requestData["ponentes"] ?? null;
            $ponentesArr = json_decode($ponentesJson, true);
            foreach ($ponentesArr as $ponente) {
                $newPonente = new Ponente();
                $newPonente->setNombre($ponente['nombre']);
                $newPonente->setCargo($ponente['cargo']);
                $newPonente->setUrl($ponente['url']);
                $newPonente->setDetalleActividad($detalleActividad);
//                $detalleActividad->addPonente($ponente);
                $this->entityManager->persist($newPonente);
            }

            foreach ($gruposIds as $grupoId) {
                $grupo = $this->grupoRepository->find($grupoId);
                $detalleActividad->addGrupo($grupo);
            }


            $detalleActividad->setNombre($description);
            $detalleActividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
            $detalleActividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
            if ($idActividad != null) {
                $actividadPadre = $this->actividadRepository->find($idActividad);
                $detalleActividad->setActividad($actividadPadre);
            }

            $this->entityManager->persist($detalleActividad);
            $this->entityManager->flush();

            return $detalleActividad->getId();
        }
    }


    public function update($requestData): int
    {
        $idActividad = $requestData['idActividad'] ?? null;

        $detalleActividad = $this->detalleActividadRepository->find($idActividad);
        if (!$detalleActividad) {
            throw new \Exception('DetalleActividad no encontrada');
        }

        $description = $requestData['descripcion'] ?? null;
        $fechaHoraInicio = $requestData['fechaHoraInicio'] ?? null;
        $fechaHoraFin = $requestData['fechaHoraFin'] ?? null;

        if ($requestData['isCompuesta']) {
            $actividad = $this->actividadRepository->find($idActividad);

            if (!$actividad || !$detalleActividad) {
                throw new \Exception('Actividad no encontrada');
            }

            $idEvento = $requestData['idEvento'] ?? null;
            $evento = $this->eventoRepository->find($idEvento);

            $actividad->setNombre($description);
            $actividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
            $actividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
            $actividad->setCompuesta($requestData['isCompuesta']);
            $actividad->setEvento($evento);

            $this->entityManager->persist($actividad);

            $detalleActividad->setNombre($description);
            $detalleActividad->setFechaHoraInicio(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraInicio));
            $detalleActividad->setFechaHoraFin(\DateTime::createFromFormat('d/m/Y H:i', $fechaHoraFin));
            $detalleActividad->setActividad($actividad);

            $this->entityManager->persist($detalleActividad);
            $this->entityManager->flush();

            $this->entityManager->flush();

            return $actividad->getId();
        } else {

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

            $ponentesJson = $requestData["ponentes"] ?? null;
            $ponentesArr = json_decode($ponentesJson, true);
            foreach ($ponentesArr as $ponente) {
                $newPonente = new Ponente();
                $newPonente->setNombre($ponente['nombre']);
                $newPonente->setCargo($ponente['cargo']);
                $newPonente->setUrl($ponente['url']);
                $newPonente->setDetalleActividad($detalleActividad);

                $this->entityManager->persist($newPonente);
            }

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
