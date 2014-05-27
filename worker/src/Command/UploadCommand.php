<?php

namespace src\Command;


use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Formatter\OutputFormatterStyle;
use Symfony\Component\DependencyInjection\ContainerInterface as container;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Bundle\FrameworkBundle\Console\Application;
use InstantMovie\BackendBundle\Entity\RelUserMovie;

class UploadCommand extends ContainerAwareCommand 
{

    protected function configure()
    {
        $this->setName("command:upload")
             ->setDescription("Subir peliculas");
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
            $em = $this->getDoctrine()->getManager();

        if($_POST)
        {

            $actorsCollection = $request->request->get('actors');
            $actores = array();

            foreach($actorsCollection as $actors)
            {
                $actores[] = explode(';',$actors);
            }

            $directorCollection = $request->request->get('director');
            $directores = array();
            foreach($directorCollection as $directors)
            {
                $directores[] = explode(';',$directors);
            }

            $title = $request->request->get('titleUp');
            $image = $request->request->get('imageUp');
            $url = $request->request->get('urlUp');
            $countryUp = $request->request->get('countryUp');
            $typeUp = $request->request->get('typeUp');
            $synapses = $request->request->get('synopsisUp');
            $date = $request->request->get('dateUp');
            $score = $request->request->get('minbeds');
            $user_id = $request->request->get('user_id');
            $comment = $request->request->get('comment');

            if(!$this->ifExistMovie($title))
            {

                $movie = new Movie();
                $movie->setTitle($title);
                $movie->setImage($image);
                $movie->setSynapses($synapses);
                $movie->setUrl($url);
                $movie->setDate(new \DateTime('NOW'));

                $subidaPor = $em->find('BackendBundle:User', $user_id);
                $movie->setSubidaPor($subidaPor);
                

                $gender = $em->find('BackendBundle:Gender', $typeUp);
                $movie->setType($gender);

                $countrys = $em->find('BackendBundle:Country', $countryUp);
                $movie->setCountry($countrys);

                foreach($directores as $directors)
                {
                    if(!$this->ifExistDirector($directors[0]))
                    {
                        $director = new Director();
                        $director->setName($directors[0]);
                        $director->setLastName($directors[1]);

                        $em->persist($director);
                        $em->flush();
                    }
                    else
                    {
                        $director = $em->find('BackendBundle:Director', $this->nameDirectorforId($directors[0]));
                    }
                    $movie->addDirector($director);
                }

                foreach($actores as $actor)
                {
                    if(!$this->ifExistActor($actor[0]))
                    {
                        $actorObject = new Actor();
                        $actorObject->setName($actor[0]);
                        $actorObject->setLastName($actor[1]);
                        $em->persist($actorObject);
                        $em->flush();
                    }
                    else
                    {
                        $actorObject = $em->find('BackendBundle:Actor',  $this->nameActorforId($actor[0]));
                    }
                    $movie->addActor($actorObject);
                }
                $relUserMovie = new RelUserMovie();

                
                $em->persist($movie);
                $em->flush();

                $user = $em->find('BackendBundle:User', $user_id);
                $movieId = $em->find('BackendBundle:Movie', $this->valorationUploadMovie($title));
                $relUserMovie->setMovie($movieId);
                $relUserMovie->setUser($user);
                $relUserMovie->setValoration($score);
                $relUserMovie->setViewDate(new \DateTime('NOW'));
                $relUserMovie->setComment($comment);


                    
                $em->persist($relUserMovie);
                $em->flush();
            }

            return $this->render('FrontendBundle:Default:portada.html.twig');
        }
        $genderCollection = $em->getRepository('BackendBundle:Gender')->findAll();
        $countryCollection = $em->getRepository('BackendBundle:Country')->findAll();
        $actorsCollection = $em->getRepository('BackendBundle:Actor')->findAll();
        $directorsCollection = $em->getRepository('BackendBundle:Director')->findAll();

        return $this->render('FrontendBundle:Default:upload.html.twig', array('gender' => $genderCollection, 'country' => $countryCollection, 'actors' => $actorsCollection, 'directors'=> $directorsCollection));
    }

    public function ifExistDirector($director)
    {
        $em = $this->getDoctrine()->getManager();
        $directorsCollection = $em->getRepository('BackendBundle:Director')->findByName($director);

        if(empty($directorsCollection))
        {
            return false;
        }else {
            return true;
        }
    }

    public function ifExistMovie($title)
    {
        $em = $this->getDoctrine()->getManager();
        $moviesCollection = $em->getRepository('BackendBundle:Movie')->find($title);

        if(empty($moviesCollection))
        {
            return false;
        }else {
            return true;
        }
    }

    public function ifExistActor($actors)
    {
        $em = $this->getDoctrine()->getManager();
        $actorsCollection = $em->getRepository('BackendBundle:Actor')->findByName($actors);

        if(empty($actorsCollection))
        {
            return false;
        }else {
            return true;
        }
    }

    public function nameActorforId($actors)
    {
        $em = $this->getDoctrine()->getManager();
        $actorsCollection = $em->getRepository('BackendBundle:Actor')->findByName($actors);

        foreach($actorsCollection as $actorId)
        {
            $idActor = $actorId->getId();
        }

        return $idActor;
    }

    public function nameDirectorforId($directores)
    {

        $em = $this->getDoctrine()->getManager();
        $directorsCollection = $em->getRepository('BackendBundle:Director')->findByName($directores);

        foreach($directorsCollection as $directorId)
        {
            $idDirector = $directorId->getId();
        }

        return $idDirector;
    }

    public function valorationUploadMovie($title)
    {
        $em = $this->getDoctrine()->getManager();
        $movieCollection = $em->getRepository('BackendBundle:Movie')->findByTitle($title);
         
        foreach($movieCollection as $movieId)
        {
            $idMovie = $movieId->getId();
        }

        return $idMovie;
    }

}
