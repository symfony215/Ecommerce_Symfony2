<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitsController extends Controller
{

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categorieAction($id)
    {
        $produits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findByCategorie($id);

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits));
    }

    public function produitsAction()
    {
        $produits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findAll();

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits));
    }

    public function presentationAction($id)
    {
        $produit = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->find($id);

        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig', array('produit'=>$produit));
    }
}
