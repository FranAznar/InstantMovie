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


class ModoNormalController extends Controller
{

# Renderiza la pagina de Peliculas

    public function peliculasAction()
    {
        return $this->render('FrontendBundle:Default:peliculas.html.twig');
    }


    public function mnormalAction()
    {
         $peticion = $this->getDoctrine()->getManager();
         $movies = $peticion->getRepository('BackendBundle:Movie')->findAll();
         return $this->render('FrontendBundle:Default:mnormal.html.twig', array('movies' => $movies));
    }

# Muestra datos de las peliculas del Modo Normal

    public function mnormalAjaxAction(Request $request)
    {
        $movie_id = $request->request->get('movie_id');

        $em = $this->getDoctrine()->getManager();
        $movieCollection = $em->getRepository('BackendBundle:Movie')->find($movie_id);

        $movieActores = array();
        $actors = array();

        foreach($movieCollection->getActors() as $movieActors)
        {
            $movieActores[]= $movieActors->getName();

            $actorsCollection = $em->getRepository('BackendBundle:Actor')->findByName($movieActores);
           
        }
         foreach( $actorsCollection as $actores)
            {
                $actors[] = $actores;
            }

        foreach($movieCollection->getDirector() as $directors){}

        $puntuacionMedia = $this->mediaPuntuacion($movie_id);
        $comentarios = $this->mostrarComentarios($movie_id);

        return $this->render('FrontendBundle:Default:mnormalAjax.html.twig', array('movie' => $movieCollection,'valoration' =>$puntuacionMedia, 'actors' => $actors, 'directors' => $directors, 'comentarios' => $comentarios, 'actores' => $actors));
    }

# funcion para sacar la meida de las puntuaciones

    public function mediaPuntuacion($movie_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $relusermovieCollection = $em->getRepository('BackendBundle:RelUserMovie')->findByMovie($movie_id);
        $valoration = 0;
        foreach($relusermovieCollection as $relUserMovie)
        {
            if(!isset($count))
                {
                    $count = 0;
                }
                $count++;
            if(!$relUserMovie->getValoration())
            {
                $count--;
            }
            $valoration += $relUserMovie->getValoration();
        }
        
        $media = $valoration / $count;
      
        return $media;
    }

# mostrar comentario

    public function mostrarComentarios($movie_id)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $relUserMovieCollection = $em->getRepository('BackendBundle:RelUserMovie')->findByMovie($movie_id);

        return $relUserMovieCollection;
    }


#Introducir Puntuacion

    public function introducirPuntuacionAction()
    {

        $request = $this->getRequest();
        $movie_id = $request->request->get('movie_id');
        error_log($movie_id);
        $user_id = $request->request->get('user_id');
        error_log($user_id);
        $score = $request->request->get('score');
        error_log($score);

        $em = $this->getDoctrine()->getManager();

        $movieCollection = $em->getRepository('BackendBundle:RelUserMovie')->findBy(array('movie' => $movie_id, 'user' => $user_id));

        foreach($movieCollection as $movie)
        {
            $movieValoration = $movie->getValoration();
        }
        
        if(empty($movieValoration))
        {
            
            $em = $this->getDoctrine()->getEntityManager();
            $user = $em->find('BackendBundle:User', $user_id);
            $movie = $em->find('BackendBundle:Movie', $movie_id);
            
            $relUserMovie = new RelUserMovie();
            $relUserMovie->setMovie($movie);
            $relUserMovie->setUser($user);
            $relUserMovie->setValoration($score);
            $relUserMovie->setViewDate(new \DateTime("now"));
            error_log("BreakPoint");
            $em->persist($relUserMovie);
            $em->flush();
            error_log("he votado");
            
        }else
        {
            error_log("ya has votado");
        }
    }

# Enlaces

    public function enlacesAction()
    {
        $request = $this->getRequest();
        $movie_id = $request->query->get('movie_id');
        $movie_id = $request->get('movie_id');
        error_log($movie_id);

        $user_id = $request->query->get('user_id');
        $user_id = $request->get('user_id');
        error_log($user_id);

         $em = $this->getDoctrine()->getManager();

        $relUserMovie = new RelUserMovie();

        $user = $em->find('BackendBundle:User', $user_id);
        $movie = $em->find('BackendBundle:Movie', $movie_id);

        $relUserMovie->setViewDate(new \DateTime("now"));
        $relUserMovie->setMovie($movie);
        $relUserMovie->setUser($user);
        $em->persist($relUserMovie);
        $em->flush();

        $movieCollection = $em->getRepository('BackendBundle:Movie')->find($movie_id);

        return $this->render('FrontendBundle:Default:enlaces.html.twig', array('movies' => $movieCollection));

    }

}
