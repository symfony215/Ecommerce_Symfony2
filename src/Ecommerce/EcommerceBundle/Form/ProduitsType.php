<?php

namespace Ecommerce\EcommerceBundle\Form;

use Ecommerce\EcommerceBundle\Entity\Categories;
use Ecommerce\EcommerceBundle\Entity\Tva;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProduitsType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class,array('attr'=>array('class'=>'form-control')))
            ->add('description',TextareaType::class,array('attr'=>array('class'=>'form-control')))
            ->add('prixHT',NumberType::class,array('label'=>'PrixHT','attr'=>array('class'=>'form-control')))
            ->add('disponible',CheckboxType::class)
            ->add('media',MediaType::class)
            ->add('tva')
            ->add('categorie')
        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Ecommerce\EcommerceBundle\Entity\Produits'
        ));
    }
}
