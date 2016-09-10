<?php

namespace Ecommerce\EcommerceBundle\Forms;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class TestType extends AbstractType{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        //Construct the form here in PHP, no more HTML
        $builder
            ->add('email','email')
            ->add('nom','text')
            ->add('pass','password')
            ->add('Q','radio')
            ->add('Date','date')
            ->add('ch','checkbox')
            ->add('send','submit');
    }

    public function getName()
    {
        return 'ecommerce_ecommercebundle_test';
    }


}