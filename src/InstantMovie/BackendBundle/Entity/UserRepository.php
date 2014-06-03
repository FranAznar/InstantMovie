<?php

namespace InstantMovie\BackendBundle\Entity;

use Doctrine\ORM\EntityRepository;
use InstantMovie\BackendBundle\Entity\User;



class UserRepository extends EntityRepository
{
    public function updateUser($user_id )
    {

        $qb = $this->em->createQueryBuilder();
        $q = $qb->update('BackendBundle:User', 'u')
                ->set('u.nickname', '?1')
                ->set('u.email', '?2')
                ->where('u.id = ?3')
                ->setParameter(1, 'Desconocido')
                ->setParameter(2, 'Desconocido@Desconocido.com')
                ->setParameter(3, $user_id)
                ->getQuery();
         $p = $q->execute();
        return $p;
    }
}
