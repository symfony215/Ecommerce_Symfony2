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
            ->add('nom')
            ->add('pass','password')
            ->add('Choice','choice',array('choices'=>array('0'=>'1', '1'=>'2'),
                           'expanded'=>true))
            ->add('Date','date')
            ->add('datetime','datetime')
            ->add('ch','checkbox')
            ->add('Sexe','choice',array('choices'=>array('0'=>'Homme',
                                                        '1'=>'Femme',
                                                        '2'=>'autres'),'preferred_choices' => array(1)))
            ->add('Msg','textarea',array('required'=>false))
            ->add('pays','country',array('preferred_choices' => array('JP')))
            ->add('Users','entity',array('class'=>'Users\UsersBundle\Entity\User'))
            ->add('send','submit');
    }

    public function getName()
    {
        return 'ecommerce_ecommercebundle_test';
    }


}