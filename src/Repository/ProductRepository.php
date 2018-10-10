<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Product;

class ProductRepository extends EntityRepository
{
    public function findAll()
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('p')->from(Product::class, 'p')->orderBy('p.createdAt', 'DESC')
            ->getQuery()
            ->getResult();
    }
}