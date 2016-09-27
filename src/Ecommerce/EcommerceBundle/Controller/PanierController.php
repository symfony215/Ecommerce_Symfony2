<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Users\UsersBundle\Entity\Commandes;
use Users\UsersBundle\Entity\User;
use Users\UsersBundle\Entity\UsersAdresses;
use Users\UsersBundle\Form\UsersAdressesType;

class  PanierController extends Controller
{

    public function adresseSuppressionAction(UsersAdresses $id = null)
    {

        $sess = new Session();

        if($id == null)
        {
            $sess->getFlashBag()->add('error','L\'adresse que vous essayez de supprimer n\'existe pas! ' );

            return $this->redirectToRoute("livraison");
        }

        $user = $this->get('security.token_storage')->getToken()->getUser();/* @var $user User*/

        if($id->getUser() != $user)
        {
            $sess->getFlashBag()->add('error','L\'adresse que vous essayez de supprimer ne vous appartient pas! ' );
            return $this->redirectToRoute("livraison");
        }


        $em = $this->getDoctrine()->getManager();
        $em->remove($id);
        $em->flush();
        $sess->getFlashBag()->add('success','Adresse supprimée avec succès! ' );
        return $this->redirectToRoute("livraison");
    }

    public function menuAction(Request $request)
    {
        $session = $request->getSession();
        if($session->has('panier'))
            $article = count($session->get('panier'));
        else
            $article = 0;

        return $this->render('EcommerceBundle:Default:panier/modulesUsed/menu.html.twig', array('nbrArticles'=>$article));
    }

    public function supprimerAction(Request $request,$id)
    {
        $session = $request->getSession();
        $panier = $session->get('panier');

        if(array_key_exists($id, $panier))
            unset($panier[$id]);

        $session->set('panier', $panier);

        $sess = new Session();

        $sess->getFlashBag()->add('success','Article supprimé avec succès ! ' );

        return $this->redirectToRoute("panier");
    }

    public function ajouterAction(Request $request,$id)
    {
        $session = $request->getSession();
        
        if(!$session->has('panier'))
            $session->set('panier', array());

        $panier = $session->get('panier');
        
        $qte = $request->query->get('qte');

        if(array_key_exists($id, $panier))
        {
            if($qte != null)
                $panier[$id] = intval($qte);

            $sess = new Session();
            $sess->getFlashBag()->add('success','Quantité modifiée avec succès ! ' );
        }
        else
        {
            if($qte != null)
                $panier[$id] = intval($qte);
            else
                $panier[$id] = 1;

            $sess = new Session();
            $sess->getFlashBag()->add('success','Article ajouté avec succès ! ' );
        }

        $session->set('panier', $panier);

        return $this->redirectToRoute("panier");
    }

    public function panierAction(Request $request)
    {
        $session = $request->getSession();

        if(!$session->has('panier'))
            $session->set('panier', array());

        $panier = $session->get('panier');

        $produits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findArray(array_keys($panier));
        

        return $this->render('EcommerceBundle:Default:panier/layout/panier.html.twig',
            array('produits'=>$produits,'panier'=>$panier));
    }

    public function livraisonAction(Request $request)
    {
        $user = $this->get('security.token_storage')->getToken()->getUser();
        $form = $this->createForm(UsersAdressesType::class,new UsersAdresses());

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $userAdresses = $form->getData();

            $userAdresses->setUser($user);

            $this->getDoctrine()->getManager()->persist($userAdresses);
            $this->getDoctrine()->getManager()->flush();

            $sess = new Session();

            $sess->getFlashBag()->add('success','Adresse ajoutée avec succès ! ' );
        }

        return $this->render('EcommerceBundle:Default:panier/layout/livraison.html.twig',array('user'=>$user,'form'=>$form->createView()));
    }

    public function setLivraisononSession(Request $request)
    {
        $session = $request->getSession();
        
        if(!$session->has('adresse')) $session->set('adresse', array());

        $adresse = $session->get('adresse');

        if($request->request->get('livraison') != null && $request->request->get('facturation') != null)
        {
            $adresse['livraison'] = $request->get('livraison');
            $adresse['facturation'] = $request->get('facturation');

            $session->set('adresse',$adresse);
        }
        else
            return $this->redirectToRoute("livraison");

        return $this->redirectToRoute("validation");
    }

    public function validationAction(Request $request)
    {
        if($request->getMethod() == 'POST')
            $this->setLivraisononSession($request);

        $prepareCommande = $this->forward('UsersBundle:Commandes:prepareCommande');
        /* @var $commande Commandes */
        $commande = $this->getDoctrine()->getRepository('UsersBundle:Commandes')->find($prepareCommande->getContent());

        return $this->render('EcommerceBundle:Default:panier/layout/validation.html.twig',
            array('commande'=>$commande));
    }

}
