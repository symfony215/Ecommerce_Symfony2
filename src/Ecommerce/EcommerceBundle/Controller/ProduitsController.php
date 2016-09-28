<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\Categories;
use Ecommerce\EcommerceBundle\Forms\searchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller
{

    public function produitsAction(Request $request,Categories $categorie = null)
    {
        $route = $request->attributes->get('_route');
        
        if($categorie != null)
            $findProduits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findByCategorie($categorie);

        else if( $route == 'produitsCategorie' )
        {
            return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig',
                array('categorieNotFound'=>true,
                    'produits'=>null));
        }
        else
            $findProduits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findBy(array('disponible'=>1));

        $session = $request->getSession();

        if($session->has('panier'))
            $panier = $session->get('panier');
        else
            $panier = false;


        $produits =  $this->get('knp_paginator')->paginate($findProduits, $request->query->get('page', 1)/*page number*/, 6/*limit per page*/);

        if($categorie != null)
            return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('categorie'=>$categorie,'produits'=>$produits,'panier'=>$panier));

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits,'panier'=>$panier));
    }

    public function presentationAction(Request $request,$id)
    {
        $produit = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->find($id);

        $session = $request->getSession();

        if($produit)
        {
            if($session->has('panier'))
            {
                $panier = $session->get('panier');

                if(array_key_exists($produit->getId(), $panier ))
                {
                    return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig',
                        array('produit'=>$produit,'panier'=>true));
                }
            }
        }

        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig',
            array('produit'=>$produit));
    }

    public function renderFormAction()
    {
        $form = $this->createForm(searchType::class);

        return $this->render('EcommerceBundle:Default:recherche/search.html.twig', array('form'=>$form->createView()));
    }

    public function searchAction(Request $request)
    {
        $form = $this->createForm(new searchType());

        $form->handleRequest($request);

        if ($request->getMethod() === 'POST' && $form->isSubmitted() && $form->isValid()) {

            $search = $form['search']->getData();

            $produits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->search($search);

            return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('search'=>true,'produits'=>$produits));
        }
        else
        {
            return $this->redirectToRoute('produits');
        }
    }
}
