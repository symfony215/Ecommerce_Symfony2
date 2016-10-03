<?php

namespace Users\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Users\UsersBundle\Entity\Commandes;
use Users\UsersBundle\Entity\VillesMaroc;

class UserController extends Controller
{

    public function villeAction($nom)
    {
        $villesObj = $this->getDoctrine()->getRepository('UsersBundle:VillesMaroc')->byNom($nom);

        if($villesObj == null)
            return null;

        $villes = array();

        $i = 0;
        /**
         * @var $value VillesMaroc
         */
        foreach ($villesObj as $value)
        {
            $villes[$i] = $value->getVille();
            $i++;
        }

        $json = new JsonResponse();

        return $json->setData($villes);
    }


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

        $pdf = $this->container->get('generatePDF')->generatePDF($commande);

        $filename = 'facture - '.$commande->getReference();

        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly
    }

}
