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

class WorkerCommand extends ContainerAwareCommand 
{

    protected function configure()
    {
        $this->setName("command:worker")
             ->setDescription("hola mundo");
    }
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        
            
            $i=0;
            $em = $this->getContainer()->get('doctrine')->getEntityManager();
            $redis = $this->getContainer()->get('snc_redis.default');
            $relUserMovie = new RelUserMovie();
            
            while($i<1000)
            {
                $i++;
                sleep(1);
                $json = $redis->lpop('comentarios');
                
                if($json)
                {
                    $json = json_decode($json);
                    $user_id = $json->user_id;
                    $movie_id = $json->movie_id;
                    $comment = $json->comment;
                    
                    $user = $em->find('BackendBundle:User', $user_id);
                    $movie = $em->find('BackendBundle:Movie', $movie_id);
                    $relUserMovie = new RelUserMovie();
                    $relUserMovie->setUser($user);
                    $relUserMovie->setMovie($movie);
                    $relUserMovie->setComment($comment);
                    $relUserMovie->setViewDate(new \DateTime('NOW'));
                    
                    $em->persist($relUserMovie);
                    $em->flush();
                    
                    $token = $json->token;
                    $redis->set($token,1);
                   
                }
            }
    }
}





