<?php

namespace InstantMovie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use InstantMovie\BackendBundle\Entity\User;
use InstantMovie\BackendBundle\Entity\Actor;
use InstantMovie\BackendBundle\Entity\Movie;
use InstantMovie\BackendBundle\Entity\RelUserMovie;
use InstantMovie\FrontendBundle\Form\Frontend\UserRegisterType;


class ModoRandomController extends Controller
{

# Configuracion Modo Random

    public function mrandomAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $movieCollection = $em->getRepository('BackendBundle:Movie')->findAll();
        $actorCollection = $em->getRepository('BackendBundle:Actor')->findAll();
        $directorCollection = $em->getRepository('BackendBundle:Director')->findAll();
        $genderCollection = $em->getRepository('BackendBundle:Gender')->findAll();

        return $this->render('FrontendBundle:Default:mrandom.html.twig', array('movies' => $movieCollection,'actors' => $actorCollection, 'director' => $directorCollection, 'gender' => $genderCollection));
    }

    public function randomAction()
    {
        $em = $this->getDoctrine()->getEntityManager();
        $movieCollection = $em->getRepository('BackendBundle:Movie')->findAll();

        foreach($movieCollection as $movie)
        {
            if(!isset($count))
            {
                $count = 0;
            }
            $count++;
            $enlaces[] =  $movie->getUrl();
        }

            $random = (int)rand(0, $count -1);
            error_log($random);
            $enlaceRandom = $enlaces[$random];

        return $this->render('FrontendBundle:Default:random.html.twig', array('enlaces' => $enlaces, 'random' => $enlaceRandom));
    }

    public function matizarAction(Request $request)
    {
        $director_id = $request->request->get('director');
        $gender_id = $request->request->get('gender');
        $actors_id = $request->request->get('actor');

        $em = $this->getDoctrine()->getManager();

        $director = $this->checkIfDirectorItsNull($director_id, $em);
        $actors = $this->checkIfActorItsNull($actors_id, $em);
        $gender = $this->checkIfDirectorItsNull($gender_id, $em);
        $genderId = $em->find('BackendBundle:Gender', $gender);

        $movieCollection = $em->getRepository('BackendBundle:Movie')->movieWithParameters($actors, $director, $genderId);

        $movie = array();

        
        foreach($movieCollection as $movieObject)
        {
            
            if(!isset($count))
            {
                $count = 0;
            }
            $count++;
            $movie[] = $movieObject;
        }

        $random = (int)rand(0, ($count = $count -1));
        error_log($random);
        $enlaceRandom = $movie[$random];

        return $this->render('FrontendBundle:Default:matizar.html.twig', array('movies' => $enlaceRandom));
    }

    public function checkIfDirectorItsNull($director, $em)
    {
        if(!$director)
        {
            $directorsCollection = $em->getRepository('BackendBundle:Director')->findAll();
            
            foreach($directorsCollection as $directors)
            {
                if(!isset($count))
                {
                    $count = 0;
                }
                $count++;
            }
            $director = $random = (int)rand(1, $count);
            
        }
        return $director;
    }

    public function checkIfActorItsNull($actor, $em)
    {
        if(!$actor)
        {
            $actorsCollection = $em->getRepository('BackendBundle:Actor')->findAll();
            
            foreach($actorsCollection as $actors)
            {
                if(!isset($count))
                {
                    $count = 0;
                }
                $count++;
            }
            $actor = $random = (int)rand(1, $count);
            
        }
        return $actor;
    }

     public function checkIGenderItsNull($gender, $em)
    {
        if(!$gender)
        {
            $actorsCollection = $em->getRepository('BackendBundle:Gender')->findAll();
            
            foreach($actorsCollection as $genders)
            {
                if(!isset($count))
                {
                    $count = 0;
                }
                $count++;
            }
            $gender = $random = (int)rand(1, $count);
            
        }
        return $gender;
    }

}
