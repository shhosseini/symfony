<?php

namespace NEWS\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * CommentRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */

class CommentRepository extends EntityRepository
{
    public function getCommentsForNews($postId)
    {
        $qb = $this->createQueryBuilder('c')
            ->select('c')
            ->where('c.post = :post_id')
            ->addOrderBy('c.submitTime')
            ->setParameter('post_id', $postId);


        return $qb->getQuery()
            ->getResult();
    }
}