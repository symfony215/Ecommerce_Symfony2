<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Ecommerce\EcommerceBundle\Forms\searchType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ProduitsController extends Controller
{

    /**
     * @param $id
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function categorieAction($id)
    {

        $categorie = $this->getDoctrine()->getRepository('EcommerceBundle:Categories')->find($id);

        if(!$categorie)
            return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig',
                array('categorieNotFound'=>true,
                    'produits'=>null));

        $produits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findByCategorie($id);

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits));
    }

    public function produitsAction()
    {
        $produits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findBy(array('disponible'=>1));

        return $this->render('EcommerceBundle:Default:produits/layout/produits.html.twig', array('produits'=>$produits));
    }

    public function presentationAction($id)
    {
        $produit = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->find($id);

        return $this->render('EcommerceBundle:Default:produits/layout/presentation.html.twig',
            array('produit'=>$produit));
    }

    public function renderFormAction()
    {
        $form = $this->createForm(new searchType());

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
