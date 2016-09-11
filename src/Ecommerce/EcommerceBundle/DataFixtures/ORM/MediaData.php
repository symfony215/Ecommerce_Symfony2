<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/09/2016
 * Time: 14:08
 */

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Media;

class LoadMediaData  extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $media1 = new Media();
        $media1->setPath('http://calopsitte.e-monsite.com/medias/images/8-1-.png');
        $media1->setAlt('légumes');
        $manager->persist($media1);

        $media2 = new Media();
        $media2->setPath('http://www.fruitselect.com/209-301-large/corbeille-de-fruits-saint-valentin-amour-livraison.jpg');
        $media2->setAlt('Fruits');
        $manager->persist($media2);

        $media3 = new Media();
        $media3->setPath('http://www.france-culinaire.com/wp-content/uploads/2013/07/poivrons-rouges.jpg');
        $media3->setAlt('Poivron rouge');
        $manager->persist($media3);

        $media4 = new Media();
        $media4->setPath('http://condrozbelge.com/wp-content/uploads/2013/10/PimentRouge2.jpg');
        $media4->setAlt('Piment');
        $manager->persist($media4);

        $media5 = new Media();
        $media5->setPath('http://www.vitaprim.com/wp-content/gallery/tomates/la-tomate.jpg');
        $media5->setAlt('Tomate');
        $manager->persist($media5);

        $media6 = new Media();
        $media6->setPath('http://fruitsetlegumesdestrinites.com/media/catalog/product/cache/1/image/9df78eab33525d08d6e5fb8d27136e95/i/s/istock_000014250412_extrasmall.jpg');
        $media6->setAlt('Poivron vert');
        $manager->persist($media6);

        $media7 = new Media();
        $media7->setPath('http://www.hortitecnews.com/sites/default/files/styles/large/public/field/image/raisin.jpg?itok=8yTatiKX');
        $media7->setAlt('Raisin');
        $manager->persist($media7);

        $media8 = new Media();
        $media8->setPath('http://cdn.shopify.com/s/files/1/0260/2057/files/navel-orange.jpg?7532');
        $media8->setAlt('Orange');
        $manager->persist($media8);

        $manager->flush();

        $this->addReference('mediaLegumes',$media1);
        $this->addReference('mediaFruits',$media2);
        $this->addReference('mediaPoivronRouge',$media3);
        $this->addReference('mediaPiment',$media4);
        $this->addReference('mediaTomate',$media5);
        $this->addReference('mediaPoivronVert',$media6);
        $this->addReference('mediaRaisin',$media7);
        $this->addReference('mediaOrange',$media8);

    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 1;
    }
}