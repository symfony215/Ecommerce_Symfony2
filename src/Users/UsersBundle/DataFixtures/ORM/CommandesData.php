<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/09/2016
 * Time: 15:19
 */

namespace Users\UsersBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Users\UsersBundle\Entity\Commandes;
use Users\UsersBundle\Entity\User;

class LoadCommandesData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $commande1 = new Commandes();
        $user1 = $this->getReference('elsam');/* @var $user1 User */
        $commande1->setUser($user1);
        $commande1->setDate(new \DateTime());
        $commande1->setValider(true);
        $commande1->setReference(1);
        $commande1->setProduits(array('0' => array('1' => '2'),
                                        '1' => array('2' => '1'),
                                          '2' => array('4' => '5') ));
        $manager->persist($commande1);

        $commande2 = new Commandes();
        $user2 = $this->getReference('client');/* @var $user2 User */
        $commande2->setUser($user2);
        $commande2->setDate(new \DateTime());
        $commande2->setValider(true);
        $commande2->setReference(2);
        $commande2->setProduits(array('0' => array('1' => '2'),
            '1' => array('2' => '1'),
            '2' => array('4' => '5') ));
        $manager->persist($commande2);

        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 7;
    }
}