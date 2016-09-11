<?php

namespace Ecommerce\EcommerceBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Ecommerce\EcommerceBundle\Entity\Categories;
use Ecommerce\EcommerceBundle\Entity\Media;
use Ecommerce\EcommerceBundle\Entity\Produits;
use Ecommerce\EcommerceBundle\Entity\Tva;

class LoadProduitsData  extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {

        $produit1 = new Produits();
        $produit1->setNom('Poivron rouge');
        $produit1->setPrixHT(1.99);
        $produit1->setDescription('oddly open a star!');
        $produit1->setDisponible(true);
            $tva1 = $this->getReference('tva 20');/* @var $tva1 Tva */
            $categorie1 = $this->getReference('categorieLegumes'); /* @var $categorie1 Categories */
            $media1 = $this->getReference('mediaPoivronRouge'); /* @var $media1 Media */
        $produit1->setTva($tva1);
        $produit1->setCategorie($categorie1);
        $produit1->setMedia($media1);
        $manager->persist($produit1);


        $produit2 = new Produits();
        $produit2->setNom('Piment');
        $produit2->setPrixHT(3.99);
        $produit2->setDescription('ionicis tormentos mori! ');
        $produit2->setDisponible(true);
            $tva2 = $this->getReference('tva 20');/* @var $tva2 Tva */
            $categorie2 = $this->getReference('categorieLegumes'); /* @var $categorie2 Categories */
            $media2 = $this->getReference('mediaPiment'); /* @var $media2 Media */
        $produit2->setTva($tva2);
        $produit2->setCategorie($categorie2);
        $produit2->setMedia($media2);
        $manager->persist($produit2);


        $produit3 = new Produits();
        $produit3->setNom('Tomate');
        $produit3->setPrixHT(0.99);
        $produit3->setDescription('diatrias ridetis! ');
        $produit3->setDisponible(true);
            $tva3 = $this->getReference('tva 20');/* @var $tva3 Tva */
            $categorie3= $this->getReference('categorieFruits');/* @var $categorie3 Categories */
            $media3 = $this->getReference('mediaTomate');/* @var $media3 Media */
        $produit3->setTva($tva3);
        $produit3->setCategorie($categorie3);
        $produit3->setMedia($media3);
        $manager->persist($produit3);





        $produit4 = new Produits();
        $produit4->setNom('Poivron vert');
        $produit4->setPrixHT(2.99);
        $produit4->setDescription('hilotaes mori! ');
        $produit4->setDisponible(true);
            $tva4 = $this->getReference('tva 20');/* @var $tva4 Tva */
            $categorie4 = $this->getReference('categorieLegumes');/* @var $categorie4 Categories */
            $media4 = $this->getReference('mediaPoivronVert');/* @var $media4 Media */
        $produit4->setTva($tva4);/* @var $this->getReference('tva 20') Tva*/
        $produit4->setCategorie($categorie4);
        $produit4->setMedia($media4);
        $manager->persist($produit4);


        $produit5 = new Produits();
        $produit5->setNom('Raisin');
        $produit5->setPrixHT(0.97);
        $produit5->setDescription('be crystal. ');
        $produit5->setDisponible(true);
            $tva5 = $this->getReference('tva 20');/* @var $tva5 Tva */
            $categorie5 = $this->getReference('categorieFruits');/* @var $categorie5 Categories */
            $media5 = $this->getReference('mediaRaisin');/* @var $media5 Media */
        $produit5->setTva($tva5);
        $produit5->setCategorie($categorie5);
        $produit5->setMedia($media5);
        $manager->persist($produit5);


        $produit6 = new Produits();
        $produit6->setNom('Orange');
        $produit6->setPrixHT(1.20);
        $produit6->setDescription('sons stutter with greed! ');
        $produit6->setDisponible(true);
            $tva6 = $this->getReference('tva 20');/* @var $tva6 Tva */
            $categorie6 = $this->getReference('categorieFruits');/* @var $categorie6 Categories */
            $media6 = $this->getReference('mediaOrange');/* @var $media6 Media */
        $produit6->setTva($tva6);
        $produit6->setCategorie($categorie6);
        $produit6->setMedia($media6);
        $manager->persist($produit6);

        $manager->flush();
    }

    public function getOrder()
    {
        // the order in which fixtures will be loaded
        // the lower the number, the sooner that this fixture is loaded
        return 4;
    }
}

