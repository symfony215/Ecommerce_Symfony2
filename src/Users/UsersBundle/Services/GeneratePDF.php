<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 28/09/2016
 * Time: 22:51
 */

namespace Users\UsersBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Users\UsersBundle\Entity\Commandes;

class GeneratePDF
{
    /**
     * GeneratePDF constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function generatePDF(Commandes $facture)
    {
        $html = $this->container->get('templating')->render('UsersBundle:Default:layout/facturePDF.html.twig', array('facture' => $facture));

        $pdf = $this->container->get("white_october.tcpdf")->create('vertical', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
        $pdf->SetAuthor('EL Sam');
        $pdf->SetTitle(('Facture - '.$facture->getReference()));
        $pdf->SetSubject('facture');
        $pdf->setFontSubsetting(true);
        $pdf->SetFont('helvetica', '', 10, '', true);
        $pdf->AddPage();

        $pdf->writeHTMLCell($w = 0, $h = 0, $x = '', $y = '', $html, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = '', $autopadding = true);

        return $pdf;
        
//        $pdf->Output($filename.".pdf",'I'); // This will output the PDF as a response directly

    }
}