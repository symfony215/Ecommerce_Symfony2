<?php

namespace Users\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Session\Session;
use Users\UsersBundle\Entity\Commandes;

class UserController extends Controller
{
    public function adressesAction()
    {
        return $this->render('UsersBundle:Default:layout/adresses.html.twig');
    }
    public function factureAction()
    {
        $factures = $this->getDoctrine()->getRepository('UsersBundle:Commandes')->byFacture($this->getUser());

        return $this->render('UsersBundle:Default:layout/facture.html.twig',array('factures'=>$factures));
    }

    public function facturePDFAction(Commandes $commande = null)
    {
        if($commande == null)
        {
            $session = new Session();
            $session->getFlashBag()->add('error','La facture designé n\'existe pas' );
            return $this->redirectToRoute('facture');
        }

//        return $this->render('UsersBundle:Default:layout/facturePDF.html.twig', array('facture' => $commande));

        return $this->container->get('generatePDF')->generatePDF($commande);
    }

}
