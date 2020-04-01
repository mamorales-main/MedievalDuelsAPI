<?php

namespace App\Repository;

use App\Entity\EquipoPersonajes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method EquipoPersonajes|null find($id, $lockMode = null, $lockVersion = null)
 * @method EquipoPersonajes|null findOneBy(array $criteria, array $orderBy = null)
 * @method EquipoPersonajes[]    findAll()
 * @method EquipoPersonajes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipoPersonajesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, EquipoPersonajes::class);
    }

    // /**
    //  * @return EquipoPersonajes[] Returns an array of EquipoPersonajes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?EquipoPersonajes
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
