<?php

namespace Users\UsersBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Users\UsersBundle\Entity\Commandes;

/**
 * Commandes controller.
 *
 */
class CommandesAdminController extends Controller
{
    /**
     * Lists all Commandes entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $commandes = $em->getRepository('UsersBundle:Commandes')->findAll();

        return $this->render('UsersBundle:Administration:commandes/index.html.twig', array(
            'commandes' => $commandes,
        ));
    }

    /**
     * Finds and displays a Commandes entity.
     *
     */
    public function showAction(Commandes $commande)
    {
        return $this->render('UsersBundle:Administration:commandes/show.html.twig', array(
            'commande' => $commande,
        ));
    }
}
