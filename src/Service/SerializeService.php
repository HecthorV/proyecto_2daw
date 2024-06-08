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
            'isCompuesta' => $actividad->isCompuesta()
        ];
    }


}
