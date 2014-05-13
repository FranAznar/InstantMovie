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
        return $this->render('FrontendBundle:Default:portada.html.twig');
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
