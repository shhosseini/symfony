<?php

namespace NEWS\BlogBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * SubscribersRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class SubscribersRepository extends EntityRepository
{
    public function findByCategory($category){

        $results = $this->createQueryBuilder('s')
            ->where('s.category' == $category)
            ->getQuery()->getResult();

        $emails = $results->getEmail();

        return $emails;
    }

    public function findByCategoryID($id){

        $results = $this->createQueryBuilder('s')
            ->where('s.category.id' == $id)
            ->getQuery()->getResult();

        return $results;
    }

    public function findEmailsByCategory($category)
    {
         $result = $this->getEntityManager()
            ->createQuery(
            'SELECT s.email FROM NEWSBlogBundle:Subscribers s WHERE s.category =:category')
             ->setParameter('category', $category)
             ->getResult();

        return $result;

    }
}
