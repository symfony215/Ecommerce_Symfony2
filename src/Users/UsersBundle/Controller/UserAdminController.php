<?php

namespace Users\UsersBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use Users\UsersBundle\Entity\User;

/**
 * User controller.
 *
 */
class UserAdminController extends Controller
{
    /**
     * Lists all User entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('UsersBundle:User')->findAll();

        return $this->render('UsersBundle:Administration:user/index.html.twig', array(
            'users' => $users,
        ));
    }

    /**
     * Finds and displays a User entity.
     *
     */
    public function userAction(Request $request,User $user = null)
    {

        if($user != null)
        {
            $route = $request->get('_route');

            if($route == 'adminUsers_adresses')
                return $this->render('UsersBundle:Administration:user/adresses.html.twig', array(
                    'user' => $user,
                ));

            else if($route == 'adminUsers_factures')
                return $this->render('UsersBundle:Administration:user/factures.html.twig', array(
                    'user' => $user,
                ));
            else
                throw $this->createNotFoundException('La vue n\'existe pas');
        }
        else
            throw $this->createNotFoundException('Ce client n\'existe pas');
    }

    public function adminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('UsersBundle:Commandes')->findAll();

        return $this->render('UsersBundle:Administration:commandes/index.html.twig', array(
            'commandes' => $commandes,
        ));
    }
}
