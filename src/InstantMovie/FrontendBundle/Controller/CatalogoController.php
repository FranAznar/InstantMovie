<?php

namespace InstantMovie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use InstantMovie\BackendBundle\Entity\User;
use InstantMovie\BackendBundle\Entity\Movie;
use InstantMovie\BackendBundle\Entity\RelUserMovie;
use InstantMovie\FrontendBundle\Form\Frontend\UserRegisterType;


class CatalogoController extends Controller
{
    public function catalogoAction()
    {
        $em = $this->getDoctrine()->getManager();
        $movieCollection = $em->getRepository('BackendBundle:Movie')->findAll();
        return $this->render('FrontendBundle:Default:catalogo.html.twig', array('movies' => $movieCollection));
    }
}
