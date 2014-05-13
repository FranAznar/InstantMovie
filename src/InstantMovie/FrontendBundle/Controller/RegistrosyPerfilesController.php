<?php

namespace InstantMovie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use InstantMovie\BackendBundle\Entity\User;
use InstantMovie\BackendBundle\Entity\Movie;
use InstantMovie\BackendBundle\Entity\RelUserMovie;
use InstantMovie\FrontendBundle\Form\Frontend\UserRegisterType;


class RegistrosyPerfilesController extends Controller
{

# Renderiza la primera vista donde el usuario se loguea.

    public function loguerAction()
    {
        return $this->render('FrontendBundle:Default:loguer.html.twig');
    }


     public function loginAction()
   {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR,
        $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        return $this->render('FrontendBundle:Default:login.html.twig', array(
        'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
        'error'         => $error
        ));
          
   }

# Configuracion de la Caja de login del Loguer.

    public function cajaLoginAction()
    {
        $peticion = $this->getRequest();
        $sesion = $peticion->getSession();
        $error = $peticion->attributes->get(
        SecurityContext::AUTHENTICATION_ERROR,
        $sesion->get(SecurityContext::AUTHENTICATION_ERROR)
        );

        return $this->render('FrontendBundle:Default:cajaLogin.html.twig', array(
        'last_username' => $sesion->get(SecurityContext::LAST_USERNAME),
        'error'         => $error
        ));
    }

# Configuracion del registro y su formulario Autogenerado
        public function registroAction()
        {
            $peticion = $this->getRequest();
            $user = new User();
            $formulario = $this->createForm(new UserRegisterType(), $user);
            $formulario->handleRequest($peticion);

            if ($formulario->isValid())
            {
                    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                    $user->setSalt(md5(time()));
                    $passwordCodificado = $encoder->encodePassword($user->getPassword(),$user->getSalt());
                    $user->setPassword($passwordCodificado);
                    $em = $this->getDoctrine()->getManager();
                    $em->persist($user);
                    $em->flush();
                    $this->get('session')->getFlashBag()->add('info','¡Enhorabuena! Te has registrado correctamente en InstanMovie');
                    return $this->render('FrontendBundle:Default:loguer.html.twig', array('user' => $user));
            }
            return $this->render('FrontendBundle:Default:registro.html.twig',array('formulario' => $formulario->createView()));
        }



# Configuracion del perfil de usuarios.
        public function perfilAction()
        {
            $user = $this->get('security.context')->getToken()->getUser();
            $formulario = $this->createForm(new UserRegisterType(), $user);
            $peticion = $this->getRequest();
            $passwordOriginal = $formulario->getData()->getPassword();
            $formulario->handleRequest($peticion);

            if ($formulario->isValid()) 
            {
                 if (null == $user->getPassword()) {
                    $usuario->setPassword($passwordOriginal);
                } else {
                    $encoder = $this->get('security.encoder_factory')->getEncoder($user);
                    $passwordCodificado = $encoder->encodePassword($user->getPassword(),$user->getSalt());
                    $user->setPassword($passwordCodificado);
                }
                $em = $this->getDoctrine()->getManager();
                $em->persist($user);
                $em->flush();
            $this->get('session')->getFlashBag()->add('info', 'Los datos de tu perfil se han actualizado correctamente');
            return $this->redirect($this->generateUrl('usuario_perfil'));
            }
            return $this->render('FrontendBundle:Default:perfil.html.twig', array(
            'user' => $user, 'formulario' => $formulario->createView()));
        }
}




