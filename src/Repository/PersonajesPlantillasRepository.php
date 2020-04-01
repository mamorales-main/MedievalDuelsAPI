<?php

namespace App\Repository;

use App\Entity\PersonajesPlantillas;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PersonajesPlantillas|null find($id, $lockMode = null, $lockVersion = null)
 * @method PersonajesPlantillas|null findOneBy(array $criteria, array $orderBy = null)
 * @method PersonajesPlantillas[]    findAll()
 * @method PersonajesPlantillas[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PersonajesPlantillasRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PersonajesPlantillas::class);
    }

    public function cogerP($clase) {
        $em = $this->getEntityManager();
        $sql =
            '
            Select p from App:PersonajesPlantillas p where p.clase = :clase
            ';
        $query = $em->createQuery($sql)
            ->setParameter('clase', $clase);

        $plantillaseleccionada = $query->getArrayResult();
        return ($plantillaseleccionada);

    }
    public function crearP($fuerza,$destreza,$inteligencia,$nivel,$clase) {
        $em = $this->getEntityManager();
        $qb1 = $em->getConnection()->createQueryBuilder();
        $qb1->insert('personajes_plantillas')
            ->values(array(
                'fuerza' => '?',
                'destreza' => '?',
                'inteligencia' => '?',
                'nivel' => '?',
                'clase' => '?'
            ))
            ->setParameter(0, $fuerza)
            ->setParameter(1, $destreza)
            ->setParameter(2, $inteligencia)
            ->setParameter(3, $nivel)
            ->setParameter(4, $clase);

        return $qb1->execute();

    }



}
