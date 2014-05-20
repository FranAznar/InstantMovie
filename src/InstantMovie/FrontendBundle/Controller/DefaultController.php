<?php

namespace InstantMovie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use InstantMovie\BackendBundle\Entity\User;
use InstantMovie\BackendBundle\Entity\Movie;
use InstantMovie\BackendBundle\Entity\RelUserMovie;
use InstantMovie\FrontendBundle\Form\Frontend\UserRegisterType;


class DefaultController extends Controller
{

# renderiza la portada
    public function portadaAction()
    {
        $em = $this->getDoctrine()->getManager();
        $historialCollection = $em->getRepository('BackendBundle:RelUserMovie')->findAll();
        $uploadCollection = $em->getRepository('BackendBundle:Movie')->findAll();

        return $this->render('FrontendBundle:Default:portada.html.twig', array('historial' => $historialCollection, 'uploads' => $uploadCollection));
    }

# Permisos del usuario
    public function defaultAction()
    {
        $user = $this->get('security.context')->getToken()->getUser();
        if ($this->get('security.context')->isGranted('ROLE_VISITANTE')) 
        {
          return $this->render('FrontendBundle:Default:portada.html.twig');
        }
        elseif ($this->get('security.context')->isGranted('ROLE_USUARIO')) {
        return $this->render('FrontendBundle:Default:perfil.html.twig');
            throw new AccessDeniedException();
        }
            $name = $user->getName();
    }


}
