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
use Users\UsersBundle\Entity\User;
use Users\UsersBundle\Entity\UsersAdresses;

class LoadAdressesData extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $adresse1 = new UsersAdresses();
        $user1 = $this->getReference('elsam');/* @var $user1 User */
        $adresse1->setUser($user1);
        $adresse1->setNom('el');
        $adresse1->setPrenom('sam');
        $adresse1->setTelephone('0699999999');
        $adresse1->setAdresse('bd AbdelKarim EL Khattabi, Gueliz');
        $adresse1->setVille('Marrakech');
        $adresse1->setPays('Morocco');
        $adresse1->setCp('40140');
        $adresse1->setComplement('Wind at the moon was the disconnection of anomaly, accelerated to a futile astronaut.');
        $manager->persist($adresse1);

        $adresse2 = new UsersAdresses();
        $user2 = $this->getReference('client');/* @var $user2 User */
        $adresse2->setUser($user2);
        $adresse2->setNom('X');
        $adresse2->setPrenom('client');
        $adresse2->setTelephone('0611111111');
        $adresse2->setAdresse('Jamaa el fna');
        $adresse2->setVille('Marrakech');
        $adresse2->setPays('Morocco');
        $adresse2->setCp('40140');
        $adresse2->setComplement('Going to the realm of freedom doesn’t develop resurrection anymore than inventing creates ancient pain.');
        $manager->persist($adresse2);
        
        $manager->flush();

    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 6;
    }
}