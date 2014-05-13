<?php 

namespace InstantMovie\FrontendBundle\Listener;

use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Router;


class LoginListener
{
    private $router, $nickname = null;
    
    public function __construct(Router $router)
    {
        $this->router = $router;
    } 


    public function onSecurityInteractiveLogin(InteractiveLoginEvent $event)
    {
        $token = $event->getAuthenticationToken();
        $this->nickname = $token->getUser()->getNickname();
    }

    public function onKernelResponse(FilterResponseEvent $event)
    {
        if ($this->nickname)
        {
            //TODO: Apuntar a PortadaAction y que la acción se encarge de crear el entityManager y obtener toda 
            //la información del usuario para trabajar en la portada.

            $portada = $this->router->generate('portada', array('nickname' => $this->nickname));
            $event->setResponse(new RedirectResponse($portada));
        }
    }
}
