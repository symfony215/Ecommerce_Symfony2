<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Ecommerce\EcommerceBundle\Forms\TestType;
use Symfony\Component\HttpFoundation\Request;

class TestController extends Controller
{

    public function testFormAction(Request $request)
    {

        $form = $this->createForm(new TestType());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $tab = $form->getData();
            $email = $form['email']->getData();
            echo $tab['email']."<br>";
            echo $email."<br>";

            $user = $form['Users']->getData();
            echo $user->getId();

            $form = $this->createForm(new TestType(),array('email'=>$email));
        }

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