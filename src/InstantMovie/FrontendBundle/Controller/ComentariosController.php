<?php

namespace InstantMovie\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\HttpFoundation\Request;
use InstantMovie\BackendBundle\Entity\User;
use InstantMovie\BackendBundle\Entity\Movie;
use InstantMovie\BackendBundle\Entity\RelUserMovie;
use InstantMovie\FrontendBundle\Form\Frontend\UserRegisterType;


class ComentariosController extends Controller
{

# Recoger y Actualizar comentarios sin actualizar la Web

    public function comentariosAjaxAction()
    {
        $request = $this->getRequest();
        $movie_id = $request->request->get('movie_id');
        $user_id = $request->request->get('user_id');
        $comment = $request->request->get('comment');

        $em = $this->getDoctrine()->getEntityManager();
        $user = $em->find('BackendBundle:User', $user_id);
        $movie = $em->find('BackendBundle:Movie', $movie_id);

        $relUserMovie = new RelUserMovie();
        $relUserMovie->setViewDate(new \DateTime("now"));
        $relUserMovie->setComment($comment);
        $relUserMovie->setMovie($movie);
        $relUserMovie->setUser($user);

        $em->persist($relUserMovie);
        $em->flush();

        return $this->render('FrontendBundle:Default:comentariosAjax.html.twig', array('comentario' => $relUserMovie));
    }

    public function comentariosAction(Request $query)
    {
        $movie_id = $query->query->get('movie_id');
        $movie_id = $query->get('movie_id');


        $peticion = $this->getDoctrine()->getManager();
        $comentarios = $peticion->getRepository('BackendBundle:RelUserMovie')->findByMovie($movie_id);

        return $this->render('FrontendBundle:Default:comentarios.html.twig', array('comentarios' => $comentarios,'movie_id' => $movie_id));
    }


}
