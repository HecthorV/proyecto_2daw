<?php

namespace App\Repository;

use App\Entity\AlumnoDetalleActividad;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<AlumnoDetalleActividad>
 *
 * @method AlumnoDetalleActividad|null find($id, $lockMode = null, $lockVersion = null)
 * @method AlumnoDetalleActividad|null findOneBy(array $criteria, array $orderBy = null)
 * @method AlumnoDetalleActividad[]    findAll()
 * @method AlumnoDetalleActividad[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AlumnoDetalleActividadRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AlumnoDetalleActividad::class);
    }

    //    /**
    //     * @return AlumnoDetalleActividad[] Returns an array of AlumnoDetalleActividad objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('a.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?AlumnoDetalleActividad
    //    {
    //        return $this->createQueryBuilder('a')
    //            ->andWhere('a.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
