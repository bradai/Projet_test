<?php

namespace AppBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * FioulRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class FioulRepository extends EntityRepository
{

    /**
     * @param $id
     * @param $date_debut
     * @param $date_fin
     *
     * @return array
     */
    public function searchFiouls($id,$date_debut,$date_fin)
    {

        $query = $this->createQueryBuilder('p')

            ->select('p.code_postal','p.amount','p.date')
            ->Where('p.date BETWEEN :start AND :end')
            ->setParameter('start', $date_debut)
            ->setParameter('end',   $date_fin)
            ->andWhere('p.code_postal LIKE :S')
            ->setParameter('S', $id)
            ->getQuery();

        $Projet = $query->getResult();

        return $Projet;
    }
}
