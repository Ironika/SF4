<?php

namespace App\Repository;

use Doctrine\ORM\EntityRepository;
use App\Entity\Blog;

class BlogRepository extends EntityRepository
{
    public function findByTag($tag)
    {
        return $this->getEntityManager()
            ->createQueryBuilder()->select('b')->from(Blog::class, 'b')->join('b.tags', 't')->where('t.slug = :tag')->orderBy('b.createdAt', 'DESC')->setParameter('tag', $tag)
            ->getQuery()
            ->getResult();
    }
}