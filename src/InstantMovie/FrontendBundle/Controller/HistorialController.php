<?php

namespace InstantMovie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use InstantMovie\BackendBundle\Entity\User;
use InstantMovie\BackendBundle\Entity\Movie;
use InstantMovie\BackendBundle\Entity\RelUserMovie;
use InstantMovie\FrontendBundle\Form\Frontend\UserRegisterType;
use Symfony\Component\Validator\Constraints\DateTime;

class HistorialController extends Controller
{
# Renderiza la pagina de historiales

    public function historialAction(Request $query)
    {

        $user_id= $query->query->get('user_id');
        $user_id = $query ->get('user_id');
        error_log($user_id);

        $em = $this->getDoctrine()->getManager();
        $historialCollection = $em->getRepository('BackendBundle:RelUserMovie')->findByUser($user_id);

        return $this->render('FrontendBundle:Default:historial.html.twig', array('historial' => $historialCollection));
    }

    public function historialPeliculasAction(Request $query)
    {

        $user_id= $query->query->get('user_id');
        $user_id = $query->get('user_id');
       

        $em = $this->getDoctrine()->getManager();

        $historialCollection = $em->getRepository('BackendBundle:RelUserMovie')->findByUser($user_id);

        error_log($user_id);
        return $this->render('FrontendBundle:Default:historialPeliculas.html.twig', array('historial' => $historialCollection ));
    }

    public function historialUploadAction(Request $query)
    {
        $user_id= $query->query->get('user_id');
        $user_id = $query->get('user_id');

        $em = $this->getDoctrine()->getManager();
        $uploadsCollection = $em->getRepository('BackendBundle:Movie')->findBySubidaPor($user_id);

        return $this->render('FrontendBundle:Default:historialUpload.html.twig', array('historial' => $uploadsCollection));
    }

}

