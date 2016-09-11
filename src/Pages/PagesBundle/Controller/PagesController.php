<?php

namespace Pages\PagesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PagesController extends Controller
{
    public function menuAction()
    {
        $pages = $this->getDoctrine()->getRepository('PagesBundle:Pages')->findAll();
        
        return $this->render('PagesBundle:Default:pages/modulesUsed/menu.html.twig',array('pages'=>$pages));
    }
    
    public function pageAction($id)
    {
        $page = $this->getDoctrine()->getRepository('PagesBundle:Pages')->find($id);

        if(!$page) return $this->render('PagesBundle:Default:pages/modules/404.html.twig');

        return $this->render('PagesBundle:Default:pages/layout/pages.html.twig',array('page'=>$page));
    }

    public function notFoundAction()
    {
        return $this->render('PagesBundle:Default:pages/modules/404.html.twig');
    }
}
