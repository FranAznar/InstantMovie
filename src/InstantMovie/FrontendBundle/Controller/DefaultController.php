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
        $historialCollection = $this->getHistorialCollection($em);
        $uploadCollection = $this->getUploadCollection($em);

        return $this->render('FrontendBundle:Default:portada.html.twig', array('historial' => $historialCollection, 'uploads' => $uploadCollection));
    }

    public function getHistorialCollection($em)
    {
        $historialCollection = $em->getRepository('BackendBundle:RelUserMovie')->findAll();
        return $historialCollection;
    }

    public function getUploadCollection($em)
    {
         $uploadCollection = $em->getRepository('BackendBundle:Movie')->findAll();
         return $uploadCollection;
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
