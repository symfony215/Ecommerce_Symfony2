<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 14/09/2016
 * Time: 00:46
 */

namespace Ecommerce\EcommerceBundle\Listener;


use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpKernel\Event\GetResponseEvent;

class RedirectionListener
{
    /**
     * RedirectionListener constructor.
     */
    public function __construct(ContainerInterface $container, Session $session)
    {
        $this->session = $session;
        $this->router = $container->get('router');
        $this->securityTokenStorage = $container->get('security.token_storage');
    }

    public function onKernelRequest(GetResponseEvent $event)
    {
        $route = $event->getRequest()->attributes->get('_route');

        if($route == 'livraison' || $route == 'validation')
        {
            if($this->session->has('panier'))
                if(count($this->session->get('panier')) == 0)
                    $event->setResponse(new RedirectResponse($this->router->generate('panier')));

            if(!is_object($this->securityTokenStorage->getToken()->getUser()))
            {
                $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));

                $this->session->getFlashBag()->add('Erreur','Vous devez vous connecter pour efféctuer cette opération! ' );
            }
        }
        else if($route == 'fos_user_security_login' || $route == 'fos_user_registration_register'
        || $route == 'fos_user_resetting_reset' || $route == "fos_user_resetting_send_email")
        {
            if(is_object($this->securityTokenStorage->getToken()->getUser()))
            {
                $event->setResponse(new RedirectResponse($this->router->generate('produits')));
            }
        }
    }
}