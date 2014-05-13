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
        $director = $request->request->get('director');
        error_log($director);
        $gender = $request->request->get('gender');
        error_log($gender);
        $actors = $request->request->get('actor');
        error_log($actors);

#        $em = $this->getDoctrine()->getManager();
#        $consulta = $em->createQuery('SELECT o FROM OfertaBundle:Oferta o WHERE o.precio < 20 ORDER BY o.nombre ASC');
#        $movies = $consulta->getResult();

        return $this->render('FrontendBundle:Default:matizar.html.twig');
    }

}
