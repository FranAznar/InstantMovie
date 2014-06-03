<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use InstantMovie\BackendBundle\Entity\Actor;
use InstantMovie\BackendBundle\Entity\Director;
use InstantMovie\BackendBundle\Entity\Gender;


class MovieRepository extends EntityRepository
{
    public function movieWithParameters($actors, $director, $gender )
    {


        $qb = $this->getEntityManager()->createQueryBuilder();
        $qb ->select(array('p'))
            ->from('BackendBundle:Movie', 'p')
            ->join('p.director', 'c', 'WITH', $qb->expr()->in('c.id', $director))
            ->join('p.actors', 'a', 'WITH', $qb->expr()->in('a.id', $actors));
        $result = $qb->getQuery()->execute();
        return $result;
    }
}
