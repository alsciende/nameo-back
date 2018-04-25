<?php

declare(strict_types=1);

namespace App\Repository;

use App\Entity\Attempt;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

class AttemptRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Attempt::class);
    }

    /**
     * @return Attempt[]
     */
    public function findNewerThan(\DateTime $date): array
    {
        $qb = $this->createQueryBuilder('a');
        $qb
            ->from(Attempt::class, 'a')
            ->where('a.step = 1')
            ->andWhere('a.presentedAt > :date')
            ->orderBy('a.presentedAt')
            ->setParameter('date', $date);

        return $qb->getQuery()->getResult();
    }
}
