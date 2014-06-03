<?php

namespace InstantMovie\FrontendBundle\Tests\Controller;
require_once __DIR__.'/../../Controller/DefaultController.php';

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use InstantMovie\FrontendBundle\Controller\DefaultController;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\DependencyInjection\ContainerInterface as container;


class DefaultControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testGetHistorialCollection()
    {
        /* mock del BD*/ 
        $relUserMovie = $this->getMock('\InstantMovie\BackendBundle\Entity\RelUserMovie');
        $relUserMovie->expects($this->any())
             ->method('getId')
             ->will($this->returnValue(1));
        $relUserMovie->expects($this->any())
             ->method('getUser')
             ->will($this->returnValue(1));
        $relUserMovie->expects($this->any())
             ->method('getMovie')
             ->will($this->returnValue(1));
        $relUserMovie->expects($this->any())
             ->method('getComment')
             ->will($this->returnValue("lala"));
        $relUserMovie->expects($this->any())
             ->method('getValoration')
             ->will($this->returnValue(5));

        /*Mock del Entity Repository*/
        $relUserMovieRpository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
             ->disableOriginalConstructor()
             ->setMethods(array('findAll'))
             ->getMock();
        $relUserMovieRpository->expects($this->exactly(2))
             ->method('findAll')
             ->will($this->returnValue($relUserMovie));

        /*Mock EM a partir de BD y el ER*/
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistance\ObjectManager')
             ->disableOriginalConstructor()
             ->setMethods(array('getRepository'))
             ->getMock();
        $entityManager->expects($this->once())
             ->method('getRepository')
             ->will($this->returnValue($relUserMovieRpository));

        $defaultController = new DefaultController();
        $this->assertSame($relUserMovieRpository->findAll(), $defaultController->getHistorialCollection($entityManager));
    }

    public function testUploadCollection()
    {
       /* mock del BD*/ 
        $relUserMovie = $this->getMock('\InstantMovie\BackendBundle\Entity\Movie');
        $relUserMovie->expects($this->any())
             ->method('getId')
             ->will($this->returnValue(1));
        $relUserMovie->expects($this->any())
             ->method('getTitle')
             ->will($this->returnValue("Rambo"));
        $relUserMovie->expects($this->any())
             ->method('getUrl')
             ->will($this->returnValue("lalal"));
        $relUserMovie->expects($this->any())
             ->method('getImage')
             ->will($this->returnValue("lala"));
        $relUserMovie->expects($this->any())
             ->method('getSynapses')
             ->will($this->returnValue("laalal"));
        $relUserMovie->expects($this->any())
             ->method('getSubidaPor')
             ->will($this->returnValue(1));
        $relUserMovie->expects($this->any())
             ->method('getCountry')
             ->will($this->returnValue("España"));
        $relUserMovie->expects($this->any())
             ->method('getGender')
             ->will($this->returnValue("Action"));


        /*Mock del Entity Repository*/
        $relUserMovieRpository = $this->getMockBuilder('\Doctrine\ORM\EntityRepository')
             ->disableOriginalConstructor()
             ->setMethods(array('findAll'))
             ->getMock();
        $relUserMovieRpository->expects($this->exactly(2))
             ->method('findAll')
             ->will($this->returnValue($relUserMovie));

        /*Mock EM a partir de BD y el ER*/
        $entityManager = $this->getMockBuilder('\Doctrine\Common\Persistance\ObjectManager')
             ->disableOriginalConstructor()
             ->setMethods(array('getRepository'))
             ->getMock();
        $entityManager->expects($this->once())
             ->method('getRepository')
             ->will($this->returnValue($relUserMovieRpository));

        $defaultController = new DefaultController();
        $this->assertSame($relUserMovieRpository->findAll(), $defaultController->getUploadCollection($entityManager));
    }

    public function testPortadaAction()
    {
        $defaultController = new DefaultController();

        $uploadCollectionDouble = array('id' => 1, 'title' => "Rambo", 'url' => "lalala", 'image' => "lalala", 'synapsis' => "allala", 'gender' => "lala", 'country' => "España", 'subidoPor' => 1);

        $historialCollectionDouble = array('id' => 1, 'user_id' => 1, 'movie_id' => 1, 'comment' => "lalal", 'valoration' => 5);

        $historialCollectionStud = $this->getMockBuilder('InstantMovie\FrontendBundle\Controller\DefaultController')
            ->disableOriginalConstructor()
            ->setMethods(array('getHistorialCollection'))
            ->getMock();
        $historialCollectionStud->expects($this->once())
            ->method('getHistorialCollection')
            ->will($this->returnValue($historialCollectionDouble ));

        $uploadCollectionStud = $this->getMockBuilder('InstantMovie\FrontendBundle\Controller\DefaultController')
            ->disableOriginalConstructor()
            ->setMethods(array('getUploadCollection'))
            ->getMock();
        $uploadCollectionStud->expects($this->once())
            ->method('getUploadCollection')
            ->will($this->returnValue($uploadCollectionDouble));

        $render = $this->getMock('Symfony\Component\Templating\EngineInterface');
        $render
            ->expects($this->once())
            ->method('render')
            ->will($this->returnCallback(function($template,$arguments){
                                            return array('template' => $template, 'arguments' => $arguments);
                                         }));

        $studPortada = $this->getMockBuilder('InstantMovie\FrontendBundle\Controller\DefaultController')
                ->setMethods(array('portadaAction'))
                ->disableOriginalConstructor()
                ->getMock();
        $studPortada->expects($this->once())
                ->method('portadaAction')
                ->will($this->returnValue($render));

        /*Creamos el Em y el getDoctrine*/

        $em = $this->container->get('doctrine')->getConnection()->close();
        $this->assertSame($studPortada, $defaultController->portadaAction($em));

    }


}
