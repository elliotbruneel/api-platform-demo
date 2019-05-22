<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * CommandDetailsRepository.
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandDetailsRepository extends EntityRepository
{
    public function findBestSeller()
    {
        $qb = $this->createQueryBuilder('cd');

        return $qb
            ->select('SUM(cd.quantity) as total')
            ->addSelect('IDENTITY(cd.article) as article')
            ->leftJoin('cd.article', 'a')
            ->leftJoin('cd.command', 'c')
            ->where('c.isValidated = true')
            ->groupBy('cd.article')
            ->orderBy('total', 'DESC')
            ->setMaxResults(3)
            ->getQuery()->getResult();
    }

    public function findSimilar()
    {
        $qb = $this->createQueryBuilder('cd');

        return $qb
            ->select('SUM(cd.quantity) as total')
            ->addSelect('IDENTITY(cd.article) as article')
            ->leftJoin('cd.article', 'a')
            ->leftJoin('cd.command', 'c')
            ->where('c.isValidated = true')
            ->groupBy('cd.article')
            ->orderBy('total', 'DESC')
            ->setMaxResults(3)
            ->getQuery()->getResult();
    }
}
