<?php

namespace Users\UsersBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UserController extends Controller
{
    public function adressesAction()
    {
        return $this->render('UsersBundle:Default:layout/adresses.html.twig');
    }
    public function factureAction()
    {
        return $this->render('UsersBundle:Default:layout/facture.html.twig');
    }
}
