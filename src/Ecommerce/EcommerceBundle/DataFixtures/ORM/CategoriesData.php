<?php
/**
 * Created by PhpStorm.
 * User: Sam
 * Date: 11/09/2016
 * Time: 14:10
 */

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;


use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Categories;
use Ecommerce\EcommerceBundle\Entity\Media;

class LoadCategoriesData  extends AbstractFixture implements OrderedFixtureInterface
{

    /**
     * Load data fixtures with the passed EntityManager
     *
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $categorie1 = new Categories();
        $categorie1->setNom('Légumes');

        /* @var $media1 Media */
        $media1 = $this->getReference('mediaLegumes');
        $categorie1->setMedia($media1);

        $manager->persist($categorie1);

        $categorie2 = new Categories();
        $categorie2->setNom('Fruits');

        /* @var $media2 Media */
        $media2 = $this->getReference('mediaFruits');
        $categorie2->setMedia($media2);
        $manager->persist($categorie2);

        $manager->flush();

        $this->addReference('categorieLegumes',$categorie1 );
        $this->addReference('categorieFruits',$categorie2 );
    }

    public function getOrder()
    {
        return 2;
    }
}