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
        $em = $this->getEntityManager();

    if(!$actors && !$gender && !$director)
    {
        $query = $em->createQuery(
                    "SELECT 
                        s
                    FROM 
                        BackendBundle:Movie s ");

    }elseif(!$actors)
        {
            if(!$actors && !$gender )
            {
                $query = $em->createQuery(
                    "SELECT 
                        s.url
                    FROM 
                        BackendBundle:Movie s, BackendBundle:Director d
                    WHERE 
                        d.id = $director ");

            }elseif(!$actors && !$director)
            {
                $query = $em->createQuery(
                    "SELECT 
                        s.url
                    FROM 
                        BackendBundle:Movie s, BackendBundle:Gender g
                    WHERE 
                        g.id = $gender");
            }else
            {
                $query = $em->createQuery(
                    "SELECT 
                        s.url
                    FROM 
                        BackendBundle:Movie s, BackendBundle:Gender g , BackendBundle:Actor a
                    WHERE 
                        d.id = $director and  g.id = $gender");
            }
        }elseif(!$director)
        {
            if(!$director && !$gender)
            {
                $query = $em->createQuery(
                    "SELECT 
                        s.url
                    FROM 
                        BackendBundle:Movie s, BackendBundle:Actor a
                    WHERE 
                        a.id = $actors");
            }elseif(!$director && !$actors)
            {
                $query = $em->createQuery(
                    "SELECT 
                        s.url
                    FROM 
                        BackendBundle:Movie s, BackendBundle:Gender g
                    WHERE 
                        g.id = $gender");
            }else
            {
                $query = $em->createQuery(
                    "SELECT 
                        s.url
                    FROM 
                        BackendBundle:Movie s, BackendBundle:Gender g, BackendBundle:Actors a
                    WHERE 
                       a.id = $actors and g.id = $gender");
            }
        }elseif(!$gender){
            $query = $em->createQuery(
                "SELECT 
                    s.url
                FROM 
                    BackendBundle:Movie s, BackendBundle:Director d, BackendBundle:Actor a
                WHERE 
                    d.id = $director and  a.id = $actors");
        }
        



        return $query->getResult();
    }
}
