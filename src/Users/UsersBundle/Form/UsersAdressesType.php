<?php

namespace Users\UsersBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersAdressesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, array('label'=>'form.name'))
            ->add('prenom',TextType::class, array('label'=>'form.firstName'))
            ->add('telephone',TextType::class, array('label'=>'form.phone'))
            ->add('adresse',TextareaType::class, array('label'=>'form.Address'))
            ->add('ville',TextType::class, array('label'=>'form.city'))
            ->add('cp',TextType::class, array('label'=>'form.zip'))
            ->add('pays',CountryType::class, array('label'=>'form.country'))
            ->add('complement',TextareaType::class,array('required'=>false,'label'=>'form.complement'))
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Users\UsersBundle\Entity\UsersAdresses'
        ));
    }
}
