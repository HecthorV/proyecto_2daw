<?php
// src/Controller/Api/ActividadApi.php

namespace App\Controller\Api;

use App\Entity\Alumno;
use App\Repository\AlumnoRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route("/api/alumno", name: "actividades-")]
class AlumnoApi extends AbstractController
{

    public function __construct(
        private AlumnoRepository $alumnoRepository,
        private EntityManagerInterface $entityManagerInteface,
    ){}

    #[Route("/insertMasivo", name: "insertMasivo", methods: ["POST"]), IsGranted("ROLE_ADMIN")]
    public function insert_masivo(Request $request, EntityManagerInterface $entityManager): Response
    {
        $requestData = json_decode($request->getContent(), true);

        $alumnosData = $requestData;
        $alumnosArray = [];

        foreach ($alumnosData as $alumnoData) {
            $alumno = new Alumno();
            $alumno->setNombre($alumnoData[0]);
            $alumno->setCorreo($alumnoData[1]);

            // Limpiar y verificar la fecha
            $fechaNacimiento = str_replace("\r", "", $alumnoData[2]);
            $fechaNacimientoObj = \DateTime::createFromFormat('d/m/Y', $fechaNacimiento);

            if ($fechaNacimientoObj === false) {
                return new JsonResponse(['error' => 'Fecha de nacimiento no válida: ' . $fechaNacimiento], JsonResponse::HTTP_BAD_REQUEST);
            }

            $alumno->setFechaNacimiento($fechaNacimientoObj);

            $entityManager->persist($alumno);
            $alumnosArray[] = $alumno;
        }
        $entityManager->flush();

        return new JsonResponse(['alumnosArray' => $alumnosArray], JsonResponse::HTTP_CREATED);
    }
}