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

        $html = $this->renderView('UsersBundle:Default:layout/facturePDF.html.twig', array('facture' => $commande));

        return $this->returnPDFResponseFromHTML($html);

    }

    public function returnPDFResponseFromHTML($html){
        //set_time_limit(30); uncomment this line according to your needs
        // If you are not in a controller, retrieve of some way the service container and then retrieve it
        //$pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        //if you are in a controlller use :
        $pdf = $this->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('EL Sam');
        $pdf->SetTitle(('Facture'));
        $pdf->SetSubject('facture');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 11, '', true);
        $pdf->AddPage();

        $filename = 'facture';

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);
        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly
    }

}
