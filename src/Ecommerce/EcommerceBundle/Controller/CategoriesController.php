<?php

namespace Ecommerce\EcommerceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CategoriesController extends Controller
{
    public function allCategoriesAction()
    {
        $categories = $this->getDoctrine()->getRepository('EcommerceBundle:Categories')->findAll();

        return $this->render('EcommerceBundle:Default:categories/all_categories.html.twig', array("categories"=>$categories));
    }

}
