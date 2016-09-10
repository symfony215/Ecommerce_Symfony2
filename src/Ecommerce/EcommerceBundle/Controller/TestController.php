<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\EcommerceBundle;
use Ecommerce\EcommerceBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Tests\Resource\ResourceStub;
use Ecommerce\EcommerceBundle\Forms\TestType;

class TestController extends Controller
{

    public function testFormAction()
    {

        $form = $this->createForm(new TestType());
        return $this->render('EcommerceBundle:Default:test.html.twig',array('form'=>$form->createView()));
    }





//    public function ajoutAction()
//    {
//
//        $em = $this->getDoctrine()->getManager();

//        $produit = new Produits();
//        $produit->setNom('Avocat');
//        $produit->setDescription('bla bla');
//        $produit->setCategorie('fruit');
//        $produit->setPrixHT(0.99);
//        $produit->setTva(10.0);
//        $produit->setDisponible(true);
//        $produit->setImage('http://dieteticalespigol.cat/662-home_default/tomata-madura-eco-cal-valls-500gr.jpg');
//
//        $em->persist($produit);
//        $em->flush();
        
//        $produits = $em->getRepository('EcommerceBundle:Produits')->findAll();
//
//        return $this->render('EcommerceBundle:Default:test.html.twig',array('produits'=>$produits));
//    }

}