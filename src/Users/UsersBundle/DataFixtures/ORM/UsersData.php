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
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Users\UsersBundle\Entity\User;

class LoadUsersData extends AbstractFixture implements OrderedFixtureInterface,ContainerAwareInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setEmail('elsam@gmail.com');
        $user1->setUsername('elsam');
        $user1->setEnabled(true);
        $user1->setPassword($this->container->get('security.encoder_factory')->
                    getEncoder($user1)->encodePassword('azerty',$user1->getSalt()));
        $manager->persist($user1);

        $user2 = new User();
        $user2->setEmail('client@gmail.com');
        $user2->setUsername('client');
        $user2->setEnabled(true);
        $user2->setPassword($this->container->get('security.encoder_factory')->
                            getEncoder($user2)->encodePassword('aaaaaaaa',$user2->getSalt()));
        $manager->persist($user2);

        $manager->flush();

        $this->addReference('elsam',$user1 );
        $this->addReference('client',$user2 );
    }

    /**
     * Get the order of this fixture
     *
     * @return integer
     */
    public function getOrder()
    {
        return 5;
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
}