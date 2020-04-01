<?php

namespace App\Repository;

use App\Entity\UsuariosDetalles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method UsuariosDetalles|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsuariosDetalles|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsuariosDetalles[]    findAll()
 * @method UsuariosDetalles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosDetallesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsuariosDetalles::class);
    }





    public function new($login,$nombre,$apellidos,$pais,$telefono) {
        $em = $this->getEntityManager();
        $qb1 = $em->getConnection()->createQueryBuilder();
        $qb1->insert('usuarios_detalles')
            ->values(array(
                'login' => '?',
                'nombre' => '?',
                'apellidos' => '?',
                'pais' => '?',
                'telefono' => '?'
            ))
            ->setParameter(0, $login)
            ->setParameter(1, $nombre)
            ->setParameter(2, $apellidos)
            ->setParameter(3, $pais)
            ->setParameter(4, $telefono);

        return $qb1->execute();

    }









    // /**
    //  * @return UsuariosDetallesController[] Returns an array of UsuariosDetallesController objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsuariosDetallesController
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
