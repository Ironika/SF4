<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Collection;

class CollectionRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('c')->from(Collection::class, 'c')->orderBy('c.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}