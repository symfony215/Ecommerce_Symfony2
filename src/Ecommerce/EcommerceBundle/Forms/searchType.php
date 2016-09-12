<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/09/2016
 * Time: 22:00
 */

namespace Ecommerce\EcommerceBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class searchType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('search','text',
            array('label'=>false,
                'attr'=>array('class'=>'form-control',
                        'placeholder'=>'Chercher produits')));
    }

    public function getName()
    {
        return 'searchForm';
    }
}