<?php

namespace Users\UsersBundle\Controller;

use Ecommerce\EcommerceBundle\Entity\Produits;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Users\UsersBundle\Entity\Commandes;
use Users\UsersBundle\Entity\UsersAdresses;

class CommandesController extends Controller
{

    public function facture(Request $request)
    {
        $session = $request->getSession();

        $adresse = $session->get('adresse');
        $panier = $session->get('panier');
        $commande = array();
        $totalHT = 0;
        $tva = 0;

        /* @var $livraison UsersAdresses ,@var $facturation UsersAdresses*/
        $livraison = $this->getDoctrine()->getRepository('UsersBundle:UsersAdresses')->find($adresse['livraison']);
        $facturation = $this->getDoctrine()->getRepository('UsersBundle:UsersAdresses')->find($adresse['facturation']);
        $produits = $this->getDoctrine()->getRepository('EcommerceBundle:Produits')->findArray(array_keys($panier));

        
        foreach ($produits as $produit) /* @var  $produit Produits*/
        {
            $prixHT = $produit->getPrixHT() * $panier[$produit->getId()];

            $prixTTC = round($prixHT / $produit->getTva()->getMultiplicate(),2);

            $tva += round($prixHT * $produit->getTva()->getValeur()/100,2);

            $totalHT += $prixHT;

            $commande['produits'][$produit->getId()] = array('reference'=> $produit->getNom(),
                                                            'quantity'=>$panier[$produit->getId()],
                                                            'prixHT'=>$produit->getPrixHT(),
                                                            'prixTTC'=>$prixTTC);

            $commande['livraison'] = array('prenom'=>$livraison->getPrenom(),
                                            'nom'=>$livraison->getNom(),
                                            'telephone'=>$livraison->getTelephone(),
                                            'adresse'=>$livraison->getAdresse(),
                                            'ville'=>$livraison->getVille(),
                                            'cp'=>$livraison->getCp(),
                                            'pays'=>$livraison->getPays(),
                                            'complement'=>$livraison->getComplement());


            $commande['facturation'] = array('prenom'=>$facturation->getPrenom(),
                                            'nom'=>$facturation->getNom(),
                                            'telephone'=>$facturation->getTelephone(),
                                            'adresse'=>$facturation->getAdresse(),
                                            'ville'=>$facturation->getVille(),
                                            'cp'=>$facturation->getCp(),
                                            'pays'=>$facturation->getPays(),
                                            'complement'=>$facturation->getComplement());

        }

        $commande['totalHT'] = $totalHT;
        $commande['totalTTC'] = round($totalHT+$tva,2);
        $commande['tva'] = $tva;
        $commande['token'] = base64_encode(random_bytes(10));

        return $commande;
    }

    public function prepareCommandeAction(Request $request)
    {
        $session = $request->getSession();
        $em = $this->getDoctrine()->getManager();

        if(!$session->has('commande'))
            $commande = new Commandes();
        else
            $commande = $session->get('commande');

        /* @var $commande Commandes*/

        $commande->setDate(new \DateTime());
        $commande->setUser($this->get('security.token_storage')->getToken()->getUser());
        $commande->setValider(false);
        $commande->setReference(0);
        $commande->setCommande($this->facture($request));

        if(!$session->has('commande'))
        {
            $em->persist($commande);
            $session->set('commande',$commande );
        }

        $em->flush();

        return new Response($commande->getId());
    }

    public function validationCommandeAction(Request $request,$id )
    {
        $em = $this->getDoctrine()->getManager();

        $commande = $em->getRepository('UsersBundle:Commandes')->find($id);/* @var  $commande Commandes */

        if($commande == null || $commande->getValider() == true)
            return $this->redirectToRoute('404');

        $commande->setValider(1);
        $commande->setReference($this->container->get('setNewReference')->reference());//Service
        $em->flush();

        $session = $request->getSession();
        $session->remove('adresse');
        $session->remove('panier');
        $session->remove('commande');

        $sess = new Session();

        $sess->getFlashBag()->add('success','Votre commande est validé avec succès !' );
        return $this->redirectToRoute('facture');
    }
}