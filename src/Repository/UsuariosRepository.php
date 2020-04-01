<?php

namespace App\Repository;

use App\Entity\Usuarios;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;

/**
 * @method Usuarios|null find($id, $lockMode = null, $lockVersion = null)
 * @method Usuarios|null findOneBy(array $criteria, array $orderBy = null)
 * @method Usuarios[]    findAll()
 * @method Usuarios[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsuariosRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Usuarios::class);
    }



    public function new($login,$password) {
        $em = $this->getEntityManager();
        $qb1 = $em->getConnection()->createQueryBuilder();
        $qb1->insert('usuarios')
            ->values(array(
                'login' => '?',
                'password' => '?',
            ))
            ->setParameter(0, $login)
            ->setParameter(1, $password);

            return $qb1->execute();

    }



}
