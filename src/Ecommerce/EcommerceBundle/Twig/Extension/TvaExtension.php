<?php

namespace Ecommerce\EcommerceBundle\Twig\Extension;



class TvaExtension extends \Twig_Extension
{

    public function getName()
    {
        return 'twig.extension';
    }

    public function getFilters()
    {
        return array(new \Twig_SimpleFilter('tva',array($this,'calculTva') ));
    }

    function calculTva($prixHT,$tvaMultiplicateur)
    {
        return round($prixHT / $tvaMultiplicateur,2);
    }

}