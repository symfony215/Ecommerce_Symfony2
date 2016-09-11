<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/09/2016
 * Time: 14:50
 */

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Tva;

class LoadTvaData  extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $tva1 = new Tva();
        $tva1->setNom('TVA 1.75%');
        $tva1->setMultiplicate(0.982);
        $tva1->setValeur(1.75);
        $manager->persist($tva1);

        $tva2 = new Tva();
        $tva2->setNom('TVA 20%');
        $tva2->setMultiplicate(0.833);
        $tva2->setValeur(20);
        $manager->persist($tva2);

        $manager->flush();

        $this->addReference('tva 1.75',$tva1 );
        $this->addReference('tva 20',$tva2 );
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 3;
    }
}