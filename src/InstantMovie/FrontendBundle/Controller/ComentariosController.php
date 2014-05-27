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


class ComentariosController extends Controller
{

# Recoger y Actualizar comentarios sin actualizar la Web

    public function comentariosAction(Request $query)
    {   
        
        
        $movie_id = $query->query->get('movie_id');
        $movie_id = $query->get('movie_id');
      
        $peticion = $this->getDoctrine()->getManager();
        $comentarios = $peticion->getRepository('BackendBundle:RelUserMovie')->findByMovie($movie_id);

        return $this->render('FrontendBundle:Default:comentarios.html.twig', array('comentarios' => $comentarios,'movie_id' => $movie_id));
    }

    public function pushInQueueAction(Request $request)
    {
        $movie_id = $request->request->get('movie_id');
        $user_id = $request->request->get('user_id');
        $comment = $request->request->get('comment');
        $token = $request->request->get('token');

        $redis = $this->container->get('snc_redis.default');
        $commentsArray = array('movie_id' => $movie_id, 'user_id' => $user_id, 'comment' => $comment, 'token' => $token );
        $jsonArray = json_encode($commentsArray);
        $redis->rpush('comentarios' , $jsonArray);

        return $this->render('FrontendBundle:Default:pullInQueue.html.twig');
    }

    public function pullInQueueAction(Request $request)
    {
        $redis = $this->container->get('snc_redis.default');
        $tokenName = $request->request->get('token');
        error_log($tokenName);
        sleep(1);
        $token = $redis->get($tokenName);
        error_log('token-->'.$token);
        $tokenJson = json_decode($token);

        return new Response ($tokenJson);
    }

}
