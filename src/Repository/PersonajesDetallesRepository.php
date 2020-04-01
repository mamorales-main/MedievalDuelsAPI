<?php

namespace App\Repository;

use App\Entity\PersonajesDetalles;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PersonajesDetalles|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonajesDetalles|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonajesDetalles[]    findAll()
 * @method PersonajesDetalles[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonajesDetallesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonajesDetalles::class);
    }

    public function cogerD($nombre) {
        $em = $this->getEntityManager();
        $sql =
            '
            Select pd from App:personajesdetalles pd where pd.nombre = :nombre
            ';
        $query = $em->createQuery($sql)
            ->setParameter('nombre', $nombre);
        $personajesdetalles = $query->getArrayResult();
        return ($personajesdetalles);

    }
    public function new($nombre,$nivel,$clase,$fuerza,$destreza,$inteligencia,$exp,$expreq,$saldo) {
        $em = $this->getEntityManager();
        $qb1 = $em->getConnection()->createQueryBuilder();
        $qb1->insert('personajes_detalles')
            ->values(array(
                'nombre' => '?',
                'nivel' => '?',
                'clase' => '?',
                'fuerza' => '?',
                'destreza' => '?',
                'inteligencia' => '?',
                'exp' => '?',
                'expreq' => '?',
                'saldo' => '?',
            ))
            ->setParameter(0, $nombre)
            ->setParameter(1, $nivel)
            ->setParameter(2, $clase)
            ->setParameter(3, $fuerza)
            ->setParameter(4, $destreza)
            ->setParameter(5, $inteligencia)
            ->setParameter(6, $exp)
            ->setParameter(7, $expreq)
            ->setParameter(8, $saldo);


        return $qb1->execute();

    }

}
