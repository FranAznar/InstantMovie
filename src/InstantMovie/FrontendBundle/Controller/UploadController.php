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


class UploadController extends Controller
{
    public function uploadAction()
    {
        $request = $this->getRequest();
        $title = $request->request->get('');


        return $this->render('FrontendBundle:Default:upload.html.twig');
    }

}
