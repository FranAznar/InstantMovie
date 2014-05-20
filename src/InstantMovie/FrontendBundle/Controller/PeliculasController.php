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


class PeliculasController extends Controller
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
        error_log($movie_id);
        $em = $this->getDoctrine()->getManager();
        $movieCollection = $em->getRepository('BackendBundle:Movie')->find($movie_id);

        foreach($movieCollection->getActors() as $actors)
        {
            error_log($actors);
        }

        foreach($movieCollection->getDirector() as $directors)
        {
            error_log($directors);
        }

        $puntuacionMedia = $this->mediaPuntuacion($movie_id);
        $comentarios = $this->mostrarComentarios($movie_id);

        error_log($puntuacionMedia);
        return $this->render('FrontendBundle:Default:mnormalAjax.html.twig', array('movie' => $movieCollection,'valoration' =>$puntuacionMedia, 'actors' => $actors, 'directors' => $directors, 'comentarios' => $comentarios));
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
            if($relUserMovie->getValoration() == 0)
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
        $comment = $request->request->get('comment');
        error_log($comment);

        $em = $this->getDoctrine()->getManager();
        $consulta = $em->createQuery("SELECT r.valoration FROM BackendBundle:RelUserMovie r WHERE r.movie_id = $movie_id and r.user_id = $user_id ");
        $valorations = $consulta->getResult();

        foreach($valorations as $valoration)
        {
            
        }

        error_log($movie_id);
        if(!$valoration)
        {
            $em = $this->getDoctrine()->getEntityManager();
            $user = $em->find('BackendBundle:User', $user_id);
            $movie = $em->find('BackendBundle:Movie', $movie_id);

            $relUserMovie = new RelUserMovie();
            $relUserMovie->setMovie($movie);
            $relUserMovie->setUser($user);
            $relUserMovie->setValoration($score);
            $relUserMovie->setViewDate(new \DateTime("now"));
            $relUserMovie->setComment($comment);

            $em->persist($relUserMovie);
            $em->flush();

        }else
        {
            error_log("ya has votado");
        }
    }


# Configuracion Modo Random

    public function mrandomAction()
    {
        return $this->render('FrontendBundle:Default:mrandom.html.twig');
    }


    public function randomAction()
    {
        return $this->render('FrontendBundle:Default:random.html.twig');
    }

}
