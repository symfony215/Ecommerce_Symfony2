<?php

/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 22/09/2016
 * Time: 15:52
 */

namespace Ecommerce\EcommerceBundle\Services;


use Doctrine\ORM\EntityManager;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Users\UsersBundle\Entity\Commandes;

class GetReference
{

    /**
     * GetReference constructor.
     */
    public function __construct($securityContext, $entityManager)
    {
        /** @var  $securityContext SecurityContextInterface*/
        /** @var $entityManager EntityManager */
        $this->securityContext = $securityContext;
        $this->entityManager = $entityManager;
    }

    public function reference()
    {
        /**@var $reference Commandes */
        $reference = $this->entityManager->getRepository('UsersBundle:Commandes')->
            findOneBy(array('valider' => 1),array('id'=>'DESC'));

        if(!$reference)
            return 1;

        else
            return $reference->getReference()+1;

    }


}