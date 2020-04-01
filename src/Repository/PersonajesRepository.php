<?php

namespace App\Repository;

use App\Entity\Personajes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Personajes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Personajes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Personajes[]    findAll()
 * @method Personajes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonajesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Personajes::class);
    }

    public function coger($login) {
        $em = $this->getEntityManager();
        $sql =
            '
            Select p from App:Personajes p where p.login = :login
            ';
        $query = $em->createQuery($sql)
            ->setParameter('login', $login);
        $personajes = $query->getArrayResult();
        return ($personajes);

    }
    public function cogerN($login) {
        $em = $this->getEntityManager();
        $sql =
            '
            Select p.nombre from App:Personajes p where p.login = :login
            ';
        $query = $em->createQuery($sql)
            ->setParameter('login', $login);
        $personajes = $query->getArrayResult();
        return ($personajes);

    }

    public function new($login,$nombre) {
        $em = $this->getEntityManager();
        $qb1 = $em->getConnection()->createQueryBuilder();
        $qb1->insert('personajes')
            ->values(array(
                'login' => '?',
                'nombre' => '?',
            ))
            ->setParameter(0, $login)
            ->setParameter(1, $nombre);

        return $qb1->execute();

    }

}
