<?php

namespace App\Repository;

use App\Entity\Espacio;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Espacio>
 *
 * @method Espacio|null find($id, $lockMode = null, $lockVersion = null)
 * @method Espacio|null findOneBy(array $criteria, array $orderBy = null)
 * @method Espacio[]    findAll()
 * @method Espacio[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EspacioRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Espacio::class);
    }

    //    /**
    //     * @return Espacio[] Returns an array of Espacio objects
    //     */
    //    public function findByExampleField($value): array
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->orderBy('e.id', 'ASC')
    //            ->setMaxResults(10)
    //            ->getQuery()
    //            ->getResult()
    //        ;
    //    }

    //    public function findOneBySomeField($value): ?Espacio
    //    {
    //        return $this->createQueryBuilder('e')
    //            ->andWhere('e.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }

//    public function findByRecursos(array $recursoIds)
//    {
//        $qb = $this->createQueryBuilder('e');
//        $qb->join('e.recursos', 'r')
//            ->where($qb->expr()->in('r.id', $recursoIds))
//            ->groupBy('e.id')
//            ->having($qb->expr()->eq($qb->expr()->countDistinct('r'), count($recursoIds)));
//
//        return $qb->getQuery()->getResult();
//    }

    public function findByIdsRecursos(array $recursoIds)
    {
        $qb = $this->createQueryBuilder('er');
        $qb->select('DISTINCT er.espacio')
            ->andWhere($qb->expr()->in('er.recurso', ':recursoIds'))
            ->setParameter('recursoIds', $recursoIds);

        return $qb->getQuery()->getResult();
    }

}
