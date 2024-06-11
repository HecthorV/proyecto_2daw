<?php
// src/Service/RouteService.php

namespace App\Service;

use App\Entity\Actividad;
use App\Entity\DetalleActividad;
use App\Repository\ActividadRepository;
use App\Repository\EspacioRepository;
use App\Repository\GrupoRepository;
use App\Repository\PonenteRepository;
use Doctrine\ORM\EntityManagerInterface;

class SerializeService
{

    function serializeActividad(Actividad $actividad): array
    {
        return [
            'id' => $actividad->getId(),
            'nombre' => $actividad->getNombre(),
            'fechaHoraInicio' => $actividad->getFechaHoraInicio(),
            'fechaHoraFin' => $actividad->getFechaHoraFin(),
            'isCompuesta' => $actividad->isCompuesta(),
            'id_evento' => $actividad->getEvento() == null ? null : $actividad->getEvento()->getId(),
        ];
    }

    /*
    function serializeArrayActividadCompleto($actividades): array
    {

        $actividadesSerialized = [];
        foreach ($actividades as $actividad) {
            $actividadesSerialized = [
                'id' => $actividad->getId(),
                'nombre' => $actividad->getNombre(),
                'fechaHoraInicio' => $actividad->getFechaHoraInicio(),
                'fechaHoraFin' => $actividad->getFechaHoraFin(),
                'id_evento' => $actividad->getEvento() == null ? null : $actividad->getEvento()->getId(),
                ];
        }

        return $actividadesSerialized;
    }
*/
//        return [
//            'id' => $actividad->getId(),
//            'nombre' => $actividad->getNombre(),
//            'fechaHoraInicio' => $actividad->getFechaHoraInicio(),
//            'fechaHoraFin' => $actividad->getFechaHoraFin(),
//            'isCompuesta' => $actividad->isCompuesta(),
//            'id_evento' => $actividad->getEvento() == null ? null : $actividad->getEvento()->getId(),
//        ];



}
